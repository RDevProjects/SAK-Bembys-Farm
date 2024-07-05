<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TransaksiKeuangan;
use App\Http\Controllers\Controller;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index()
    {
        return view('inputUnit');
    }

    public function getNamaUnit()
    {
        $namaUnits = Unit::select('id_unit' ,'nama_unit')->distinct()->get();
        return DataTables::of($namaUnits)
            ->addColumn('action', function($row) {
                return '<a href="#" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-3 rounded-2xl"><i class="ti ti-edit"></i></a>
                    <a href="' . route('home') . '" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-3 rounded-2xl"><i class="ti ti-trash"></i></a>';
            })
            ->make(true);
    }

  public function store(Request $request)
    {
        $validated = $request->validate([
            'id_unit' => 'required',
            'nama_unit' => 'required',
        ]);

        Unit::create($validated);

        return redirect()->route('entry-jurnal.showNamaUnit')->with('status', 'Data transaksi berhasil ditambahkan!');
    }
}
