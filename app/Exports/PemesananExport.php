<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemesananExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pemesanan::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Kendaraan ID',
            'Driver ID',
            'Waktu Mulai',
            'Waktu Selesai',
            'Tujuan',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
}
