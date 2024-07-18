<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    //
    public function index()
    {
        $drivers = Driver::all();
        return view('admin.driver.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.driver.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor_sim' => 'required',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        Driver::create($request->all());

        return redirect()->route('admin.driver.index');
    }

    public function edit(Driver $driver)
    {
        return view('admin.driver.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'nama' => 'required',
            'nomor_sim' => 'required',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $driver->update($request->all());

        return redirect()->route('admin.driver.index');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()->route('admin.driver.index');
    }
}
