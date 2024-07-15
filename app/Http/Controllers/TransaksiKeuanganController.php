<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\KodeRekening;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TransaksiKeuangan;
use Illuminate\Support\Facades\DB;
use App\Models\KeteranganTransaksi;

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

    public function getTransaksiKeuangan()
    {
        $data = TransaksiKeuangan::with('kodeRekening', 'buktiTransaksi', 'Unit');

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
            // ->addColumn('action', function($row){
            //     $editUrl = route('entry-jurnal.edit', $row->id_jurnal);
            //     $deleteUrl = route('entry-jurnal.delete', $row->id_jurnal);
            //     return '<a href="'.$editUrl.'" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-3 rounded-2xl"><i class="ti ti-edit"></i></a>
            //             <a href="'.$deleteUrl.'" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-3 rounded-2xl"><i class="ti ti-trash"></i></a>';
            // })
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

    public function edit($id_jurnal)
    {
        $transaksi = TransaksiKeuangan::with('kodeRekening', 'buktiTransaksi', 'Unit')->find($id_jurnal);
        $tanggal_transaksi = Carbon::parse($transaksi->buktiTransaksi->tanggal_transaksi)->format('Y-m-d');
        $kodeRekenings = KodeRekening::select('kode_rek', 'nama_rek')->distinct()->get();
        $namaUnits = Unit::select('id_unit' ,'nama_unit')->distinct()->get();
        //dd($transaksi->toArray());
        //dd($tanggal_transaksi);
        return view('editEntryData', compact('transaksi', 'kodeRekenings', 'namaUnits', 'tanggal_transaksi'));
    }

    public function update(Request $request, $id_jurnal)
    {
        DB::beginTransaction();

        try {
            $KeteranganTransaksi = KeteranganTransaksi::find($id_jurnal);
            $KeteranganTransaksi->bukti_transaksi = $request->bukti_transaksi;
            $KeteranganTransaksi->tanggal_transaksi = $request->tanggal;
            $KeteranganTransaksi->keterangan = $request->keterangan;
            $KeteranganTransaksi->save();

            $TransaksiKeuangan = TransaksiKeuangan::find($id_jurnal);
            $TransaksiKeuangan->no_akun = $request->bukti_transaksi;
            $TransaksiKeuangan->account_number = $request->account_number;
            $TransaksiKeuangan->index_kas = $request->index_kas;
            $TransaksiKeuangan->id_unit = $request->id_unit;
            $TransaksiKeuangan->index_unit = $request->index_unit;
            $TransaksiKeuangan->debet = $request->debet ?? 0;
            $TransaksiKeuangan->kredit = $request->kredit ?? 0;
            $TransaksiKeuangan->save();

            DB::commit();
            return redirect('/entry-jurnal')->with('status', 'Data transaksi berhasil diubah!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/entry-jurnal')->with('error', 'Data transaksi gagal diubah!');
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
