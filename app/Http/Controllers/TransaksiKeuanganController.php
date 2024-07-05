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
        $kodeRekenings = KodeRekening::select('kode_rek', 'nama_rek')->distinct()->get();
        $namaUnits = TransaksiKeuangan::select('nama_unit')->distinct()->get();
        return view('entryData', compact('kodeRekenings', 'namaUnits'));
    }

    public function store(Request $request)
    {
         dd($request->all());
        DB::beginTransaction();

        try {
            $KeteranganTransaksi = new KeteranganTransaksi();
            $KeteranganTransaksi->bukti_transaksi = $request->bukti_transaksi;
            $KeteranganTransaksi->tanggal_transaksi = $request->tanggal;
            $KeteranganTransaksi->keterangan = $request->keterangan;
            $KeteranganTransaksi->save();

            $TransaksiKeuangan = new TransaksiKeuangan();
            $TransaksiKeuangan->id_jurnal = $KeteranganTransaksi->id;
            $TransaksiKeuangan->no_akun = $request->bukti_transaksi;
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
