<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // Mengambil data pemakaian kendaraan beserta nama kendaraannya
        $pemakaianKendaraan = DB::table('pemesanan')
            ->join('kendaraan', 'pemesanan.kendaraan_id', '=', 'kendaraan.id')
            ->select('kendaraan.nomor_plat', DB::raw('count(*) as jumlah_pemakaian'))
            ->groupBy('kendaraan.nomor_plat')
            ->get();

        return view('dashboard', compact('pemakaianKendaraan'));
    }
}
