<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::all();

        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $request->validate([
                'nomor_plat' => 'required|unique:kendaraan',
                'jenis' => 'required',
                'merk' => 'required',
                'model' => 'required',
                'tahun' => 'required|integer',
                'status' => 'required|in:tersedia,digunakan,perbaikan',
            ]);

            Kendaraan::create($request->all());
        });

        return redirect()->route('admin.kendaraan.index');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        DB::transaction(function () use ($request, $kendaraan) {
            $validated = $request->validate([
                'nomor_plat' => 'required|unique:kendaraan,nomor_plat,' ,
                'jenis' => 'required',
                'merk' => 'required',
                'model' => 'required',
                'tahun' => 'required|integer',
                'status' => 'required|in:tersedia,digunakan,perbaikan',
            ]);

            $kendaraan->update($validated);
        });

        return redirect()->route('admin.kendaraan.index');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return redirect()->route('admin.kendaraan.index');
    }
}
