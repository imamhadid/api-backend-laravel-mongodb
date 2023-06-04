<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KendaraanFactory extends Factory
{
    protected $model = Kendaraan::class;

    public function definition()
    {
        return [
            'tahun_kendaraan' => $this->faker->year,
            'warna' => $this->faker->colorName,
            'harga' => $this->faker->randomNumber(6),
            'jenis_kendaraan' => $this->faker->randomElement(['mobil', 'motor']),
            'kapasitas_penumpang' => $this->faker->randomNumber(2),
            'tipe' => $this->faker->word,
            'mesin' => $this->faker->randomElement(['1200cc', '1500cc', '2000cc']),
            'tipe_suspensi' => $this->faker->randomElement(['Depan', 'Belakang', 'Depan dan Belakang']),
            'tipe_transmisi' => $this->faker->randomElement(['Manual', 'Otomatis']),
            'status' => $this->faker->randomElement(['ready']),
        ];
    }
}
