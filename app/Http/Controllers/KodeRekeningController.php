<?php

namespace App\Http\Controllers;

use App\Models\KodeRekening;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class KodeRekeningController extends Controller
{
    public function index()
    {
        return view('dataRekening');
    }

    public function GetDataRekening()
    {
        $data = KodeRekening::latest()->get();
        return DataTables::of($data)
        ->addIndexColumn()
        ->make(true);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kode_rek' => 'required',
            'nama_rek' => 'required',
            'kelompok_rek' => 'required',
            'tipe_rek' => 'required',
            'saldo_awal' => 'required',
        ]);

        KodeRekening::create($request->all());

        return redirect()->route('data-rekening');
    }
}
