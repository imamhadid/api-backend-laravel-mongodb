<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Kendaraan extends Model
{
    use HasFactory;

    protected $collection = 'kendaraan';


    protected $fillable = [
        'tahun_kendaraan',
        'warna',
        'harga',
        'jenis_kendaraan',
        'kapasitas_penumpang',
        'tipe',
        'mesin',
        'tipe_suspensi',
        'tipe_transmisi',
        'status'
    ];

    public function kendaraanable(): MorphTo
    {
        return $this->morphTo();
    }
}
