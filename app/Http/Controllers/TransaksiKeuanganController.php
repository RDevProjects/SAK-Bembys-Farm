<?php

namespace App\Http\Controllers;

use App\Models\KodeRekening;
use Illuminate\Http\Request;
use App\Models\TransaksiKeuangan;
use Illuminate\Support\Facades\DB;
use App\Models\KeteranganTransaksi;

class TransaksiKeuanganController extends Controller
{
    public function index()
    {
        return view('entryData');
    }

    public function store(Request $request)
    {
        dd($request->all());
        DB::beginTransaction();

        try {
            $KeteranganTransaksi = new KeteranganTransaksi();
            $KeteranganTransaksi->nama_transaksi = $request->nama_transaksi;
            $KeteranganTransaksi->jenis_transaksi = $request->jenis_transaksi;
            $KeteranganTransaksi->jumlah_transaksi = $request->jumlah_transaksi;
            $KeteranganTransaksi->tanggal_transaksi = $request->tanggal_transaksi;
            $KeteranganTransaksi->save();

            $KodeRekening = new KodeRekening();
            $KodeRekening->kode_rek = $request->kode_rek;
            $KodeRekening->nama_rek = $request->nama_rek;
            $KodeRekening->kelompok_rek = $request->kelompok_rek;
            $KodeRekening->tipe_rek = $request->tipe_rek;
            $KodeRekening->saldo_awal = $request->saldo_awal;
            $KodeRekening->save();

            $TransaksiKeuangan = new TransaksiKeuangan();
            $TransaksiKeuangan->id_keterangan_transaksi = $KeteranganTransaksi->id;
            $TransaksiKeuangan->id_kode_rek = $KodeRekening->id;
            $TransaksiKeuangan->no_trx = $request->no_trx;
            $TransaksiKeuangan->account_number = $request->account_number;
            $TransaksiKeuangan->index_kas = $request->index_kas;
            $TransaksiKeuangan->nama_unit = $request->nama_unit;
            $TransaksiKeuangan->index_unit = $request->index_unit;
            $TransaksiKeuangan->debet = $request->debet;
            $TransaksiKeuangan->kredit = $request->kredit;
            $TransaksiKeuangan->save();

            DB::commit();
            return redirect('/entry-jurnal')->with('status', 'Data transaksi berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/entry-jurnal')->with('error', 'Data transaksi gagal ditambahkan!');
        }

    }
}
