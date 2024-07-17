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
        // $kode_rek = $request->kode_rek;
        $data = TransaksiKeuangan::with(['kodeRekening', 'buktiTransaksi'])
            ->select('transaksi_keuangan.*', 'keterangan_transaksi.tanggal_transaksi', 'keterangan_transaksi.keterangan')
            ->join('keterangan_transaksi', 'transaksi_keuangan.no_akun', '=', 'keterangan_transaksi.bukti_transaksi')
            //->where('account_number', $kode_rek)
            ->get();

        // return response()->json($dataRekening);
         return view('laporan.buku-besar', compact('data'));
    }

    public function indexNeracaSaldo()
    {
        $data = KodeRekening::all();

        $result = $data->map(function($item) {
            return [
                'kode_rek' => $item->kode_rek,
                'nama_rek' => $item->nama_rek,
                'debet' => $item->tipe_rek === 'DEBET' ? $item->saldo_awal : 0,
                'kredit' => $item->tipe_rek === 'KREDIT' ? $item->saldo_awal : 0,
            ];
        });

        $totalDebet = $result->sum('debet');
        $totalKredit = $result->sum('kredit');

        //dd($result);
        return view('laporan.neraca-saldo', compact('result', 'totalDebet', 'totalKredit'));
    }

    public function indexLabaRugi()
    {
        $dataPendapatan = TransaksiKeuangan::with(['kodeRekening', 'buktiTransaksi'])
            ->select('transaksi_keuangan.*', 'keterangan_transaksi.tanggal_transaksi', 'keterangan_transaksi.keterangan', 'kode_rekening.kode_rek', 'kode_rekening.nama_rek', 'transaksi_keuangan.debet', 'transaksi_keuangan.kredit')
            ->join('keterangan_transaksi', 'transaksi_keuangan.no_akun', '=', 'keterangan_transaksi.bukti_transaksi')
            ->join('kode_rekening', 'transaksi_keuangan.account_number', '=', 'kode_rekening.kode_rek')
            ->where('transaksi_keuangan.index_unit', 1)
            ->orderBy('kode_rekening.kode_rek', 'asc')
            ->get();

        $dataBiaya = TransaksiKeuangan::with(['kodeRekening', 'buktiTransaksi'])
            ->select('transaksi_keuangan.*', 'keterangan_transaksi.tanggal_transaksi', 'keterangan_transaksi.keterangan', 'kode_rekening.kode_rek', 'kode_rekening.nama_rek', 'transaksi_keuangan.debet', 'transaksi_keuangan.kredit')
            ->join('keterangan_transaksi', 'transaksi_keuangan.no_akun', '=', 'keterangan_transaksi.bukti_transaksi')
            ->join('kode_rekening', 'transaksi_keuangan.account_number', '=', 'kode_rekening.kode_rek')
            ->where('transaksi_keuangan.index_unit', 0)
            ->orderBy('kode_rekening.kode_rek', 'asc')
            ->get();
        // return response()->json($data);
         return view('laporan.laba-rugi', compact('dataPendapatan', 'dataBiaya'));
    }

    public function indexPerubahanModal()
    {
        $dataModal = KodeRekening::where('kode_rek', '3110')->get();

        $dataPendapatan = TransaksiKeuangan::with(['kodeRekening', 'buktiTransaksi'])
            ->select('transaksi_keuangan.*', 'keterangan_transaksi.tanggal_transaksi', 'keterangan_transaksi.keterangan', 'kode_rekening.kode_rek', 'kode_rekening.nama_rek', 'transaksi_keuangan.debet', 'transaksi_keuangan.kredit')
            ->join('keterangan_transaksi', 'transaksi_keuangan.no_akun', '=', 'keterangan_transaksi.bukti_transaksi')
            ->join('kode_rekening', 'transaksi_keuangan.account_number', '=', 'kode_rekening.kode_rek')
            ->where('transaksi_keuangan.index_unit', 1)
            ->orderBy('kode_rekening.kode_rek', 'asc')
            ->get();

        $dataBiaya = TransaksiKeuangan::with(['kodeRekening', 'buktiTransaksi'])
            ->select('transaksi_keuangan.*', 'keterangan_transaksi.tanggal_transaksi', 'keterangan_transaksi.keterangan', 'kode_rekening.kode_rek', 'kode_rekening.nama_rek', 'transaksi_keuangan.debet', 'transaksi_keuangan.kredit')
            ->join('keterangan_transaksi', 'transaksi_keuangan.no_akun', '=', 'keterangan_transaksi.bukti_transaksi')
            ->join('kode_rekening', 'transaksi_keuangan.account_number', '=', 'kode_rekening.kode_rek')
            ->where('transaksi_keuangan.index_unit', 0)
            ->orderBy('kode_rekening.kode_rek', 'asc')
            ->get();

        // Menghitung total debet dan kredit dari data yang diambil
        $totalPendapatan = $dataPendapatan->sum('kredit');
        $totalBiaya = $dataBiaya->sum('debet');

        // Untuk debugging, gunakan dd($data); atau Log::info($data);
        // dd($data);
        // Log::info($data);

        // Memilih salah satu return statement, JSON atau view
        // return response()->json($totalBiaya);
        return view('laporan.perubahan-modal', compact('dataModal', 'dataPendapatan', 'dataBiaya', 'totalPendapatan', 'totalBiaya'));
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
        $arusKasOperasi = TransaksiKeuangan::with('buktiTransaksi')->where('index_kas', 1)->get();
        $arusKasInvestasi = TransaksiKeuangan::with('buktiTransaksi')->where('index_kas', 2)->get();
        $arusKasPendanaan = TransaksiKeuangan::with('buktiTransaksi')->where('index_kas', 3)->get();

        $totalKreditArusKasOperasi = $arusKasOperasi->sum('kredit');
        $totalDebetArusKasOperasi = $arusKasOperasi->sum('debet');
        $totalArusKasOperasi =  $totalDebetArusKasOperasi - $totalKreditArusKasOperasi;

        $totalKreditArusKasInvestasi = $arusKasInvestasi->sum('kredit');
        $totalDebetArusKasInvestasi = $arusKasInvestasi->sum('debet');
        $totalArusKasInvestasi = $totalDebetArusKasInvestasi - $totalKreditArusKasInvestasi;

        $totalKreditArusKasPendanaan = $arusKasPendanaan->sum('kredit');
        $totalDebetArusKasPendanaan = $arusKasPendanaan->sum('debet');
        $totalArusKasPendanaan = $totalDebetArusKasPendanaan - $totalKreditArusKasPendanaan ;

        $totalKenaikanKas = $totalArusKasOperasi + $totalArusKasInvestasi + $totalArusKasPendanaan;

        // return response()->json($arusKasPendanaan);
        return view('laporan.arus-kas', compact('arusKasOperasi', 'arusKasInvestasi', 'arusKasPendanaan', 'totalKreditArusKasInvestasi', 'totalDebetArusKasInvestasi', 'totalArusKasInvestasi', 'totalKreditArusKasOperasi', 'totalDebetArusKasOperasi', 'totalArusKasOperasi', 'totalKreditArusKasPendanaan', 'totalDebetArusKasPendanaan', 'totalArusKasPendanaan', 'totalKenaikanKas'));
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
