<?php

namespace Database\Factories;

use App\Models\Penjualan;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenjualanFactory extends Factory
{
    protected $model = Penjualan::class;

    public function definition()
    {
        return [
            'id_kendaraan' => Kendaraan::factory()->create()->id,
            'id_pembeli' => User::factory()->create()->id,
        ];
    }
}
