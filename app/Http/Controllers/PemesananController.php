<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\Pemesanan;
use App\Models\Persetujuan;
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
        $kendaraan = Kendaraan::all();
        $drivers = Driver::all();
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
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'tujuan' => 'required|string',
            'status' => 'required|in:menunggu,disetujui_level1,disetujui_level2,ditolak,selesai',
            'approver1_id' => 'required|exists:users,id',
            'approver2_id' => 'required|exists:users,id',
        ]);

        $pemesanan = Pemesanan::create([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'driver_id' => $request->driver_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'tujuan' => $request->tujuan,
            'status' => $request->status,
        ]);

        // Simpan persetujuan untuk approver1
        $persetujuan1 = new Persetujuan([
            'pemesanan_id' => $pemesanan->id,
            'user_id' => $request->approver1_id,
            'level' => '1', // Sesuaikan dengan level
            'status' => 'menunggu', // Status awal persetujuan
        ]);
        $persetujuan1->save();

        // Simpan persetujuan untuk approver2
        $persetujuan2 = new Persetujuan([
            'pemesanan_id' => $pemesanan->id,
            'user_id' => $request->approver2_id,
            'level' => '2', // Sesuaikan dengan level
            'status' => 'menunggu', // Status awal persetujuan
        ]);
        $persetujuan2->save();

        return redirect()->route('admin.pemesanan.index')->with('success', 'Pemesanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $users = User::all();
        $kendaraan = Kendaraan::all();
        $drivers = Driver::all();
        $approvers = User::role('Approver')->get();

        return view('admin.pemesanan.edit', compact('pemesanan', 'users', 'kendaraan', 'drivers', 'approvers'));
    }


    public function update(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'driver_id' => 'required|exists:drivers,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'tujuan' => 'required|string',
            'status' => 'required|in:menunggu,disetujui_level1,disetujui_level2,ditolak,selesai',
            'approver1_id' => 'required|exists:users,id',
            'approver2_id' => 'required|exists:users,id',
        ]);

        $pemesanan->update([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'driver_id' => $request->driver_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'tujuan' => $request->tujuan,
            'status' => $request->status,
        ]);

        // Update persetujuan untuk approver1
        $persetujuan1 = $pemesanan->persetujuan()->where('level', '1')->first();
        if ($persetujuan1) {
            $persetujuan1->update([
                'user_id' => $request->approver1_id,
            ]);
        } else {
            $persetujuan1 = new Persetujuan([
                'pemesanan_id' => $pemesanan->id,
                'user_id' => $request->approver1_id,
                'level' => '1',
                'status' => 'menunggu',
            ]);
            $persetujuan1->save();
        }

        // Update persetujuan untuk approver2
        $persetujuan2 = $pemesanan->persetujuan()->where('level', '2')->first();
        if ($persetujuan2) {
            $persetujuan2->update([
                'user_id' => $request->approver2_id,
            ]);
        } else {
            $persetujuan2 = new Persetujuan([
                'pemesanan_id' => $pemesanan->id,
                'user_id' => $request->approver2_id,
                'level' => '2',
                'status' => 'menunggu',
            ]);
            $persetujuan2->save();
        }

        return redirect()->route('admin.pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();

        return redirect()->route('admin.pemesanan.index');
    }
}
