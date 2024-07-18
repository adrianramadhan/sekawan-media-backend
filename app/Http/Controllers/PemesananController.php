<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    //
    public function index()
    {
        $pemesanans = Pemesanan::with(['user', 'kendaraan', 'driver'])->get();
        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    public function create()
    {
        $users = User::role('admin')->get();
        $kendaraan = Kendaraan::where('status', 'tersedia')->get();
        $drivers = Driver::where('status', 'aktif')->get();
        $approvers = User::role('Approver')->get();
        return view('admin.pemesanan.create', compact('users', 'kendaraan', 'drivers', 'approvers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'driver_id' => 'required|exists:drivers,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date',
            'tujuan' => 'required|string',
            'status' => 'required|string|in:menunggu,disetujui_level1,disetujui_level2,ditolak,selesai',
        ]);

        Pemesanan::create($request->all());

        // Update status kendaraan menjadi 'digunakan'
        $kendaraan = Kendaraan::find($request->kendaraan_id);
        $kendaraan->status = 'digunakan';
        $kendaraan->save();

        // Update status driver menjadi 'tidak aktif'
        $driver = Driver::find($request->driver_id);
        $driver->status = 'tidak aktif';
        $driver->save();

        return redirect()->route('admin.pemesanan.index');
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $users = User::all();
        $kendaraan = Kendaraan::all();
        $drivers = Driver::all();
        return view('admin.pemesanan.edit', compact('pemesanan', 'users', 'kendaraan', 'drivers'));
    }


    public function update(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'driver_id' => 'required|exists:drivers,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date',
            'tujuan' => 'required|string',
            'status' => 'required|string|in:menunggu,disetujui_level1,disetujui_level2,ditolak,selesai',
        ]);

        $pemesanan->update($request->all());

    // Update status kendaraan
        $kendaraan = Kendaraan::find($request->kendaraan_id);
        if ($request->status === 'selesai') {
            $kendaraan->status = 'tersedia';
        } else {
            $kendaraan->status = 'digunakan';
        }
        $kendaraan->save();

        // Update status driver
        $driver = Driver::find($request->driver_id);
        if ($request->status === 'selesai') {
            $driver->status = 'aktif';
        } else {
            $driver->status = 'tidak aktif';
        }
        $driver->save();

        return redirect()->route('admin.pemesanan.index');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();

        return redirect()->route('admin.pemesanan.index');
    }
}
