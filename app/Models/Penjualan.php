<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use App\Models\User;
use App\Models\Kendaraan;

class Penjualan extends Model
{
    use HasFactory;

    protected $collection = 'penjualan';


    protected $fillable = [
        'id_kendaraan',
        'id_pembeli',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pembeli');
    }

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

}
