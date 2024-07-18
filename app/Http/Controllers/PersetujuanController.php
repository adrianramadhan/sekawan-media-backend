<?php

namespace App\Http\Controllers;

use App\Models\Persetujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersetujuanController extends Controller
{
    //
    public function index()
    {
        $user_id = Auth::id();

        $persetujuans = Persetujuan::where('user_id', $user_id)->with(['pemesanan', 'user'])->get();

        return view('approver.persetujuan.index', compact('persetujuans'));
    }

    public function approve($id)
    {
        $persetujuan = Persetujuan::findOrFail($id);

        // Ambil level dari record persetujuan
        $level = $persetujuan->level;

        if ($level == 1) {
            $persetujuan->update([
                'status' => 'disetujui',
            ]);

            // Update status pemesanan
            $persetujuan->pemesanan->update([
                'status' => 'disetujui_level1',
            ]);
        } elseif ($level == 2) {
            $persetujuan->update([
                'status' => 'disetujui',
            ]);

            // Update status pemesanan menjadi disetujui_level2
            $persetujuan->pemesanan->update([
                'status' => 'disetujui_level2',
            ]);
        }

        // Cek apakah semua persetujuan telah disetujui
        $allApproved = $persetujuan->pemesanan->persetujuan()
            ->where('status', '!=', 'menunggu')
            ->count() == $persetujuan->pemesanan->persetujuan()->count();

        if ($allApproved) {
            $persetujuan->pemesanan->update([
                'status' => 'disetujui',
            ]);
        }

        return redirect()->back();
    }

    public function reject($id)
    {
        $persetujuan = Persetujuan::findOrFail($id);
        $persetujuan->update([
            'status' => 'ditolak',
        ]);

        // Update status pemesanan
        $persetujuan->pemesanan->update([
            'status' => 'ditolak',
        ]);

        return redirect()->back();
    }
}
