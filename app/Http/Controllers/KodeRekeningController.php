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
            ->addColumn('action', function($row){
                $editUrl = route('data-rekening.edit', $row->kode_rek);
                return '<a href="'.$editUrl.'" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-3 rounded-2xl"><i class="ti ti-edit"></i></a>';
            })
            ->rawColumns(['action'])
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

        return redirect()->route('data-rekening')->with('message', 'Data berhasil ditambahkan');
    }

    public function edit($kode_rek)
    {
        //dd($kode_rek);
        $data = KodeRekening::find($kode_rek);
        //dd($data);
        return view('editDataRekening', compact('data'));
    }

    public function update(Request $request, $kode_rek)
    {
        $request->validate([
            'nama_rek' => 'required',
            'kelompok_rek' => 'required',
            'tipe_rek' => 'required',
            'saldo_awal' => 'required',
        ]);
        //dd($request->all());
        KodeRekening::find($kode_rek)->update($request->all());

        return redirect()->route('data-rekening')->with('message', 'Data berhasil diubah');
    }
}
