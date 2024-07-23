<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KodeRekening;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TransaksiKeuangan;
use Illuminate\Support\Facades\DB;
use App\Models\KeteranganTransaksi;
use Illuminate\Support\Facades\Log;

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
                'kelompok_rek' => $item->kelompok_rek,
                'debet' => $item->tipe_rek === 'DEBET' ? $saldo : 0,
                'kredit' => $item->tipe_rek === 'KREDIT' ? $saldo : 0,
            ];
        });

        $totalDebet = $result->sum('debet');
        $totalKredit = $result->sum('kredit');

        // Store the final balances in session
        session(['neracaSaldoAkhir' => $result]);

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

        session(['dataPendapatan' => $dataPendapatan]);

        $dataHargaPokokPenjualan = $dataHargaPokokPenjualan->groupBy('account_number')->map(function ($group) {
            return [
                'account_number' => $group[0]->account_number,
                'nama_rek' => $group[0]->kodeRekening->nama_rek,
                'saldo' => $group->sum('debet'),
            ];
        })->values();

        session(['dataHargaPokokPenjualan' => $dataHargaPokokPenjualan]);

        $dataBeban = $dataBeban->groupBy('account_number')->map(function ($group) {
            return [
                'account_number' => $group[0]->account_number,
                'nama_rek' => $group[0]->kodeRekening->nama_rek,
                'saldo' => $group->sum('debet'),
            ];
        })->values();

        session(['dataBeban' => $dataBeban]);

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

        session(['modalAkhir' => $modalAkhir]);
        // dd(session('modalAkhir'));

        return view('laporan.perubahan-modal', compact('dataModal', 'dataPendapatan', 'modalAkhir', 'labaBersih'));
    }

    public function indexNeraca()
    {
        $modalAkhir = session('modalAkhir');
        $dataSaldoAkhir = session('neracaSaldoAkhir');

        $aktivaLancar = $this->getFinancialDataByGroupFromSession($dataSaldoAkhir, 'Aktiva Lancar');
        $aktivaLancarTotal = $this->calculateTotal($aktivaLancar);

        $aktivaTetap = $this->getFinancialDataByGroupFromSession($dataSaldoAkhir, 'Aktiva Tetap');
        $aktivaTetapTotal = $this->calculateTotal($aktivaTetap);

        $aktivaLainLain = $this->getFinancialDataByGroupFromSession($dataSaldoAkhir, 'Aktiva Lain-Lain');
        $aktivaLainLainTotal = $this->calculateTotal($aktivaLainLain);

        $totalSemua = $aktivaLancarTotal + $aktivaTetapTotal + $aktivaLainLainTotal;

        $hutangJangkaPendek = $this->getFinancialDataByGroupFromSession($dataSaldoAkhir, 'Hutang Jangka Pendek');
        $jumlahHutangJangkaPendek = $this->calculateTotal($hutangJangkaPendek);

        $hutangJangkaPanjang = $this->getFinancialDataByGroupFromSession($dataSaldoAkhir, 'Hutang Jangka Panjang');
        $jumlahHutangJangkaPanjang = $this->calculateTotal($hutangJangkaPanjang);

        $totalKewajiban = $jumlahHutangJangkaPendek + $jumlahHutangJangkaPanjang;

        $modal = $this->getFinancialDataByGroupFromSession($dataSaldoAkhir, 'Modal');
        $jumlahModal = $this->calculateTotal($modal);

        $totalPasiva = $totalKewajiban + $modalAkhir;

        return view('laporan.neraca', compact(
            'aktivaLancar',
            'aktivaLancarTotal',
            'aktivaTetap',
            'aktivaTetapTotal',
            'aktivaLainLain',
            'aktivaLainLainTotal',
            'totalSemua',
            'hutangJangkaPendek',
            'jumlahHutangJangkaPendek',
            'hutangJangkaPanjang',
            'jumlahHutangJangkaPanjang',
            'totalKewajiban',
            'modal',
            'jumlahModal',
            'totalPasiva',
            'modalAkhir'
        ));
    }

    private function getFinancialDataByGroupFromSession($data, $group)
    {
        return collect($data)->filter(function ($item) use ($group) {
            return $item['kelompok_rek'] === $group;
        });
    }

    private function calculateTotal($data)
    {
        return $data->sum(function ($item) {
            if ($item['kelompok_rek'] === 'Hutang Jangka Pendek') {
                return $item['kredit'] - $item['debet'];
            } elseif ($item['kelompok_rek'] === 'Modal') {
                return $item['kredit'] - $item['debet'];
            } elseif ($item['kelompok_rek'] === 'Hutang Jangka Panjang') {
                return $item['kredit'] - $item['debet'];
            } else {
                return $item['debet'] - $item['kredit'];
            }
        });
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

    public function indexJurnalPenutup()
    {
        $labaBersih = session('labaBersih');
        $dataPendapatan = session('dataPendapatan');
        $dataHargaPokokPenjualan = session('dataHargaPokokPenjualan');
        $dataBeban = session('dataBeban');

        if (!$labaBersih || !$dataPendapatan || !$dataHargaPokokPenjualan || !$dataBeban) {
            return redirect()->back();
        }

        return view('laporan.jurnal-penutup', compact(
            'dataPendapatan',
            'dataHargaPokokPenjualan',
            'dataBeban',
            'labaBersih'
        ));
    }

    public function indexNeracaSaldoPenutup()
    {
        $labaBersih = session('labaBersih');
        // dd($labaBersih);
        // Fetch all KodeRekening
        $data = KodeRekening::whereNotIn('kelompok_rek', ['Beban', 'Pendapatan'])->get();

        $result = $data->map(function($item) use ($labaBersih){
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

            if ($item->kode_rek == 3410) {
                return [
                    'kode_rek' => $item->kode_rek,
                    'nama_rek' => $item->nama_rek,
                    'kelompok_rek' => $item->kelompok_rek,
                    'debet' => 0,
                    'kredit' => $labaBersih,
                ];
            }

            return [
                'kode_rek' => $item->kode_rek,
                'nama_rek' => $item->nama_rek,
                'kelompok_rek' => $item->kelompok_rek,
                'debet' => $item->tipe_rek === 'DEBET' ? $saldo : 0,
                'kredit' => $item->tipe_rek === 'KREDIT' ? $saldo : 0,
            ];
        });
        // dd($result);
        // return response()->json($result);
        $totalDebet = $result->sum('debet');
        $totalKredit = $result->sum('kredit');
        // dd($totalDebet, $totalKredit);
        return view('laporan.neraca-saldo-penutup', compact('result', 'totalDebet', 'totalKredit'));
    }

    public function penutupanAkuntansi()
    {
        $labaBersih = session('labaBersih');
        // dd($labaBersih);
        // Fetch all KodeRekening
        $data = KodeRekening::whereNotIn('kelompok_rek', ['Beban', 'Pendapatan'])->get();

        $result = $data->map(function($item) use ($labaBersih){
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

            if ($item->kode_rek == 3310) {
                return [
                    'kode_rek' => $item->kode_rek,
                    'nama_rek' => $item->nama_rek,
                    'kelompok_rek' => $item->kelompok_rek,
                    'saldo' => $saldo + $labaBersih,
                ];
            }

            return [
                'kode_rek' => $item->kode_rek,
                'nama_rek' => $item->nama_rek,
                'kelompok_rek' => $item->kelompok_rek,
                'saldo' => $saldo
            ];
        });
        // dd($result);
        // return response()->json($result);
        // dd($totalDebet, $totalKredit);
        return view('penutupan', compact('result', 'labaBersih'));
    }

    public function prosesPenutupanAkuntansi(Request $request)
    {
        // Ambil data dari form
        $result = $request->input('result');

        try {
            // Gunakan transaksi database untuk memastikan atomicity
            DB::beginTransaction();

            // Perbarui data di KodeRekening
            foreach ($result as $item) {
                KodeRekening::where('kode_rek', $item['kode_rek'])->update(['saldo_awal' => $item['saldo']]);
            }

            // Matikan foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Hapus semua data dari TransaksiKeuangan
            TransaksiKeuangan::truncate();

            // Hapus semua data dari KeteranganTransaksi
            KeteranganTransaksi::truncate();

            // Hidupkan kembali foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // Commit transaksi
            DB::commit();
            session()->flush(); // Reset all sessions

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            session()->flush(); // Reset all sessions
            return redirect()->back()->with('message', 'Proses penutupan buku berhasil dilakukan.');
            // return redirect()->back()->with('message', 'Proses penutupan buku gagal: ' . $e->getMessage() . ' on line ' . $e->getLine());
        }

        return redirect()->back()->with('message', 'Proses penutupan buku berhasil dilakukan.');
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
