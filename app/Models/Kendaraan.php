<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';

    protected $fillable = [
        'nomor_plat',
        'jenis',
        'merk',
        'model',
        'tahun',
        'status',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
