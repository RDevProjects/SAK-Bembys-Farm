<?php

namespace App\Http\Controllers;

use App\Models\KodeRekening;
use Illuminate\Http\Request;
use App\Models\TransaksiKeuangan;
use Illuminate\Support\Facades\DB;
use App\Models\KeteranganTransaksi;
use App\Models\Unit;
use Yajra\DataTables\DataTables;

class TransaksiKeuanganController extends Controller
{
    public function index()
    {
        $kodeRekenings = KodeRekening::select('kode_rek', 'nama_rek')->distinct()->get();
        $namaUnits = Unit::select('id_unit' ,'nama_unit')->distinct()->get();
        // menghitung jumlah debet dan kredit dan balance
        $totalDebet = TransaksiKeuangan::sum('debet');
        $totalKredit = TransaksiKeuangan::sum('kredit');
        $totalBalance = $totalDebet - $totalKredit;
        return view('entryData', compact('kodeRekenings', 'namaUnits', 'totalDebet', 'totalKredit', 'totalBalance'));
    }

    public function getTransaksiKeuangan(Request $request)
    {
        $data = TransaksiKeuangan::with('kodeRekening', 'buktiTransaksi', 'Unit')->select('transaksi_keuangan.*');

        return DataTables::of($data)
            ->addColumn('kode_rek', function($row) {
                return $row->kodeRekening ? $row->kodeRekening->kode_rek : '';
            })
            ->addColumn('nama_rek', function($row) {
                return $row->kodeRekening ? $row->kodeRekening->nama_rek : '';
            })
            ->addColumn('keterangan', function($row) {
                return $row->buktiTransaksi ? $row->buktiTransaksi->keterangan : '';
            })
            ->addColumn('tanggal_transaksi', function($row) {
                return $row->buktiTransaksi ? $row->buktiTransaksi->tanggal_transaksi : '';
            })
            ->addColumn('nama_unit', function($row) {
                return $row->Unit ? $row->Unit->nama_unit : '';
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        // dd($request->all());
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
            $TransaksiKeuangan->id_unit = $request->id_unit;
            $TransaksiKeuangan->index_unit = $request->index_unit;
            $TransaksiKeuangan->debet = $request->debet ?? 0;
            $TransaksiKeuangan->kredit = $request->kredit ?? 0;
            $TransaksiKeuangan->save();

            DB::commit();
            return redirect('/entry-jurnal')->with('status', 'Data transaksi berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/entry-jurnal')->with('error', 'Data transaksi gagal ditambahkan!');
        }

    }

    public function tampilJurnal()
    {
        $totalDebet = TransaksiKeuangan::sum('debet');
        $totalKredit = TransaksiKeuangan::sum('kredit');
        $totalBalance = $totalDebet - $totalKredit;
        return view('tampilJurnal', compact('totalDebet', 'totalKredit', 'totalBalance'));
    }
}
