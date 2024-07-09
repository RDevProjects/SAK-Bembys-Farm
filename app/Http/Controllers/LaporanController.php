<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TransaksiKeuangan;
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

    public function getDataBukuBesar(Request $request)
    {
        $kode_rek = $request->kode_rek;
        $data = TransaksiKeuangan::with(['kodeRekening', 'buktiTransaksi'])
            ->select('transaksi_keuangan.*', 'keterangan_transaksi.tanggal_transaksi', 'keterangan_transaksi.keterangan')
            ->join('keterangan_transaksi', 'transaksi_keuangan.no_akun', '=', 'keterangan_transaksi.bukti_transaksi')
            ->where('account_number', $kode_rek)
            ->get();

        // return response()->json($dataRekening);
         return view('laporan.buku-besar', compact('data'));
    }

    public function indexNeracaSaldo()
    {
        $data = TransaksiKeuangan::with(['kodeRekening', 'buktiTransaksi'])
            ->select('transaksi_keuangan.*', 'keterangan_transaksi.tanggal_transaksi', 'keterangan_transaksi.keterangan', 'kode_rekening.kode_rek', 'kode_rekening.nama_rek', 'transaksi_keuangan.debet', 'transaksi_keuangan.kredit')
            ->join('keterangan_transaksi', 'transaksi_keuangan.no_akun', '=', 'keterangan_transaksi.bukti_transaksi')
            ->join('kode_rekening', 'transaksi_keuangan.account_number', '=', 'kode_rekening.kode_rek')
            ->orderBy('kode_rekening.kode_rek', 'asc')
            ->get();
        // return response()->json($data);
         return view('laporan.neraca-saldo', compact('data'));
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
