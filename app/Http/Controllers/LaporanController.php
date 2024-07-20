<?php

namespace App\Http\Controllers;

use App\Models\KodeRekening;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TransaksiKeuangan;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function indexJurnalUmum()
    {
        $data = TransaksiKeuangan::with(['kodeRekening', 'buktiTransaksi'])
        ->select('transaksi_keuangan.*', 'keterangan_transaksi.tanggal_transaksi', 'keterangan_transaksi.keterangan')
        ->join('keterangan_transaksi', 'transaksi_keuangan.no_akun', '=', 'keterangan_transaksi.bukti_transaksi')
        ->get();
    // return response()->json($data);
    return view('laporan.jurnal-umum', compact('data'));
    }

    public function getDataJurnalUmum()
    {
        $data = TransaksiKeuangan::with(['kodeRekening', 'buktiTransaksi'])
            ->select('transaksi_keuangan.*', 'keterangan_transaksi.tanggal_transaksi', 'keterangan_transaksi.keterangan')
            ->join('keterangan_transaksi', 'transaksi_keuangan.no_akun', '=', 'keterangan_transaksi.bukti_transaksi')
            ->get();
        return response()->json($data);
        // return view('laporan.jurnal-umum', compact('data'));
    }

    public function indexBukuBesar()
    {
        $kodeRekenings = KodeRekening::all();
        return view('laporan.cari-buku-besar', compact('kodeRekenings'));
    }

    public function getDataBukuBesar(Request $request)
    {
        $kode_rek = $request->input('kode_rek');
        $kodeRekening = KodeRekening::where('kode_rek', $kode_rek)->first();
        $transaksiKeuangans = TransaksiKeuangan::with('buktiTransaksi')
            ->where('account_number', $kode_rek)
            ->get();

        return view('laporan.buku-besar', compact('kodeRekening', 'transaksiKeuangans'));
    }

    public function indexNeracaSaldo()
    {
        // Fetch all KodeRekening
        $data = KodeRekening::all();

        $result = $data->map(function($item) {
            // Fetch transactions for the current kode_rek
            $transaksiKeuangans = TransaksiKeuangan::with('buktiTransaksi')
                ->where('account_number', $item->kode_rek)
                ->get();

            // Calculate the final balance
            $saldo = $item->saldo_awal;
            foreach ($transaksiKeuangans as $transaksi) {
                if ($item->tipe_rek === 'DEBET') {
                    $saldo += $transaksi->debet;
                    $saldo -= $transaksi->kredit;
                } else {
                    $saldo -= $transaksi->debet;
                    $saldo += $transaksi->kredit;
                }
            }

            return [
                'kode_rek' => $item->kode_rek,
                'nama_rek' => $item->nama_rek,
                'debet' => $item->tipe_rek === 'DEBET' ? $saldo : 0,
                'kredit' => $item->tipe_rek === 'KREDIT' ? $saldo : 0,
            ];
        });

        $totalDebet = $result->sum('debet');
        $totalKredit = $result->sum('kredit');

        return view('laporan.neraca-saldo', compact('result', 'totalDebet', 'totalKredit'));
    }

    public function indexLabaRugi()
    {
        // Pendapatan
        $dataPendapatan = TransaksiKeuangan::with('buktiTransaksi')
            ->where('account_number', '4110')
            ->get();
        $totalPendapatan = $dataPendapatan->sum('kredit');

        // Harga Pokok Penjualan
        $dataHargaPokokPenjualan = TransaksiKeuangan::with('buktiTransaksi')
            ->whereIn('account_number', ['5130', '5140'])
            ->get();
        $totalHargaPokokPenjualan = $dataHargaPokokPenjualan->sum('debet');

        // Laba Kotor
        $labaKotor = $totalPendapatan - $totalHargaPokokPenjualan;

        // Beban
        $dataBeban = TransaksiKeuangan::with('buktiTransaksi')
            ->whereIn('account_number', ['5110', '5120'])
            ->get();
        $totalBeban = $dataBeban->sum('debet');

        // Laba Bersih
        $labaBersih = $labaKotor - $totalBeban;

        // Simpan laba bersih ke dalam session
        session(['labaBersih' => $labaBersih]);

        // Calculate the final balance for each account
        $dataPendapatan = $dataPendapatan->groupBy('account_number')->map(function ($group) {
            return [
                'account_number' => $group[0]->account_number,
                'nama_rek' => $group[0]->kodeRekening->nama_rek,
                'saldo' => $group->sum('kredit'),
            ];
        })->values();

        $dataHargaPokokPenjualan = $dataHargaPokokPenjualan->groupBy('account_number')->map(function ($group) {
            return [
                'account_number' => $group[0]->account_number,
                'nama_rek' => $group[0]->kodeRekening->nama_rek,
                'saldo' => $group->sum('debet'),
            ];
        })->values();

        $dataBeban = $dataBeban->groupBy('account_number')->map(function ($group) {
            return [
                'account_number' => $group[0]->account_number,
                'nama_rek' => $group[0]->kodeRekening->nama_rek,
                'saldo' => $group->sum('debet'),
            ];
        })->values();

        return view('laporan.laba-rugi', compact(
            'dataPendapatan',
            'totalPendapatan',
            'dataHargaPokokPenjualan',
            'totalHargaPokokPenjualan',
            'labaKotor',
            'dataBeban',
            'totalBeban',
            'labaBersih'
        ));
    }

    public function indexPerubahanModal()
    {
        // Ambil nilai laba bersih dari session
        $labaBersih = session('labaBersih');

        // Lakukan apa yang perlu dilakukan dengan labaBersih di sini
        //dd($labaBersih);
        $dataModal = KodeRekening::where('kode_rek', '3110')->get();

        $dataPendapatan = KodeRekening::whereIn('kode_rek', ['3210', '3310'])->get();
        // return response()->json($dataPendapatan);

        $modalAkhir = $dataModal->sum('saldo_awal') + $labaBersih + $dataPendapatan->sum('saldo_awal');
        // dd($modalAkhir);

        return view('laporan.perubahan-modal', compact('dataModal', 'dataPendapatan', 'modalAkhir', 'labaBersih'));
    }

    public function indexNeraca()
    {
        // Fetch data for each category
        $aktivaLancar = $this->getFinancialDataByGroup('Aktiva Lancar');
        $aktivaLancarTotal = $aktivaLancar->sum('saldo_awal');

        $aktivaTetap = $this->getFinancialDataByGroup('Aktiva Tetap');
        $aktivaTetapTotal = $aktivaTetap->sum('saldo_awal');

        $aktivaLainLain = $this->getFinancialDataByGroup('Aktiva Lain-Lain');
        $aktivaLainLainTotal = $aktivaLainLain->sum('saldo_awal');

        $totalSemua = $aktivaLancarTotal + $aktivaTetapTotal + $aktivaLainLainTotal;

        $hutangJangkaPendek = KodeRekening::where('kelompok_rek', 'Hutang Jangka Pendek')->get();
        $jumlahHutangJangkaPendek = $hutangJangkaPendek->sum('saldo_awal');

        $hutangJangkaPanjang = KodeRekening::where('kelompok_rek', 'Hutang Jangka Panjang')->get();
        $jumlahHutangJangkaPanjang = $hutangJangkaPanjang->sum('saldo_awal');

        $totalKewajiban = $jumlahHutangJangkaPendek + $jumlahHutangJangkaPanjang;

        $modal = KodeRekening::where('kelompok_rek', 'Modal')->get();
        $jumlahModal = $modal->sum('saldo_awal');

        $totalPasiva = $totalKewajiban + $jumlahModal;

        // Mendapatkan bulan saat ini
        $currentMonth = Carbon::now()->format('m');

        // Menghitung jumlah kredit dan debet untuk bulan saat ini
        $totalKredit = TransaksiKeuangan::whereMonth('created_at', $currentMonth)->sum('kredit');
        $totalDebet = TransaksiKeuangan::whereMonth('created_at', $currentMonth)->sum('debet');

        // Menghitung laba bersih
        $labaBersih = $totalKredit - $totalDebet;

        // Membulatkan laba bersih ke angka terdekat
        $labaBersihRounded = round($labaBersih, -3);

        //dd($labaBersihRounded);

        return view('laporan.neraca', compact('aktivaLancar', 'aktivaLancarTotal', 'aktivaTetap', 'aktivaTetapTotal', 'aktivaLainLain', 'aktivaLainLainTotal', 'totalSemua', 'hutangJangkaPendek', 'jumlahHutangJangkaPendek', 'hutangJangkaPanjang', 'jumlahHutangJangkaPanjang', 'totalKewajiban', 'modal', 'jumlahModal', 'totalPasiva', 'labaBersihRounded'));
    }

    private function getFinancialDataByGroup($group)
    {
        $data = KodeRekening::where('kelompok_rek', $group)->get();

        // Adjust saldo_awal based on tipe_rek
        $data->transform(function($item) {
            if ($item->tipe_rek == 'KREDIT') {
                $item->saldo_awal = -1 * $item->saldo_awal;
            }
            return $item;
        });

        return $data;
    }

    public function indexArusKas()
    {
        $arusKasOperasi = TransaksiKeuangan::whereHas('kodeRekening', function($query) {
            $query->where('index_kas', 1)->where('kode_rek', '1111')->where('tipe_rek', 'DEBET');
        })->with('buktiTransaksi')->get();

        $arusKasInvestasi = TransaksiKeuangan::whereHas('kodeRekening', function($query) {
            $query->whereIn('kode_rek', ['1310', '1320', '1330', '1340', '1350'])->where('index_kas', 2);
        })->with('buktiTransaksi')->get();

        $arusKasPendanaan = TransaksiKeuangan::whereHas('kodeRekening', function($query) {
            $query->where('index_kas', 3)->where('kode_rek', '2210')->where('tipe_rek', 'KREDIT');
        })->with('buktiTransaksi')->get();

        $totalDebetArusKasOperasi = $arusKasOperasi->sum('debet');
        $totalKreditArusKasOperasi = $arusKasOperasi->sum('kredit');
        $totalArusKasOperasi = $totalDebetArusKasOperasi - $totalKreditArusKasOperasi;

        $totalDebetArusKasInvestasi = $arusKasInvestasi->sum('debet');
        $totalKreditArusKasInvestasi = $arusKasInvestasi->sum('kredit');
        $totalArusKasInvestasi = $totalDebetArusKasInvestasi - $totalKreditArusKasInvestasi;

        $totalDebetArusKasPendanaan = $arusKasPendanaan->sum('debet');
        $totalKreditArusKasPendanaan = $arusKasPendanaan->sum('kredit');
        $totalArusKasPendanaan = $totalDebetArusKasPendanaan - $totalKreditArusKasPendanaan;

        $totalKenaikanKas = $totalArusKasOperasi + $totalArusKasInvestasi + $totalArusKasPendanaan;

        $kasAwalBulanMei2024 = KodeRekening::whereIn('kode_rek', ['1111', '1112'])->sum('saldo_awal');
        $kasAkhirBulanMei2024 = $totalKenaikanKas + $kasAwalBulanMei2024;

        return view('laporan.arus-kas', compact(
            'arusKasOperasi',
            'arusKasInvestasi',
            'arusKasPendanaan',
            'totalDebetArusKasOperasi',
            'totalKreditArusKasOperasi',
            'totalArusKasOperasi',
            'totalDebetArusKasInvestasi',
            'totalKreditArusKasInvestasi',
            'totalArusKasInvestasi',
            'totalDebetArusKasPendanaan',
            'totalKreditArusKasPendanaan',
            'totalArusKasPendanaan',
            'totalKenaikanKas',
            'kasAwalBulanMei2024',
            'kasAkhirBulanMei2024'
        ));
    }

    public function getDataJurnalUmumJson()
    {
        $data = TransaksiKeuangan::with(['kodeRekening', 'buktiTransaksi'])
            ->select('transaksi_keuangan.*', 'keterangan_transaksi.tanggal_transaksi', 'keterangan_transaksi.keterangan', 'kode_rekening.kode_rek', 'kode_rekening.nama_rek', 'transaksi_keuangan.debet', 'transaksi_keuangan.kredit')
            ->join('keterangan_transaksi', 'transaksi_keuangan.no_akun', '=', 'keterangan_transaksi.bukti_transaksi')
            ->join('kode_rekening', 'transaksi_keuangan.account_number', '=', 'kode_rekening.kode_rek')
            ->get();
        return response()->json($data);
    }
}
