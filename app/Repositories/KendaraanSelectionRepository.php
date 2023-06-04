<?php

namespace App\Repositories;

use App\Models\Kendaraan;
use App\Repositories\KendaraanRepository;

class KendaraanSelectionRepository implements KendaraanRepository
{
    public function createMobil(array $data)
    {
        $data['status'] = 'ready';
        Kendaraan::create($data);
        return $data;
    }

    public function createMotor(array $data)
    {
        $data['status'] = 'ready';
        Kendaraan::create($data);
        return $data;
    }

    public function getByFilters(array $filters)
    {
        $query = Kendaraan::query();

        if (isset($filters['jenis_kendaraan'])) {
            $query->where('jenis_kendaraan', $filters['jenis_kendaraan']);
        }

        if (isset($filters['tahun_kendaraan'])) {
            $query->where('tahun_kendaraan', $filters['tahun_kendaraan']);
        }

        if (isset($filters['warna'])) {
            $query->where('warna', $filters['warna']);
        }

        if (isset($filters['harga_min'])) {
            $query->where('harga', '>=', $filters['harga_min']);
        }

        if (isset($filters['harga_max'])) {
            $query->where('harga', '<=', $filters['harga_max']);
        }

        if (isset($filters['mesin'])) {
            $query->orWhereHas('kendaraanable', function ($q) use ($filters) {
                $q->where('mesin', $filters['mesin']);
            });
        }

        if (isset($filters['tipe_suspensi'])) {
            $query->orWhereHas('kendaraanable', function ($q) use ($filters) {
                $q->where('tipe_suspensi', $filters['tipe_suspensi']);
            });
        }

        if (isset($filters['tipe_transmisi'])) {
            $query->orWhereHas('kendaraanable', function ($q) use ($filters) {
                $q->where('tipe_transmisi', $filters['tipe_transmisi']);
            });
        }

        if (isset($filters['kapasitas_penumpang'])) {
            $query->orWhereHas('kendaraanable', function ($q) use ($filters) {
                $q->where('kapasitas_penumpang', $filters['kapasitas_penumpang']);
            });
        }

        if (isset($filters['tipe'])) {
            $query->orWhereHas('kendaraanable', function ($q) use ($filters) {
                $q->where('tipe', $filters['tipe']);
            });
        }

        return $query->paginate(10);
    }

    public function getKendaraanById($id)
    {
        $data = Kendaraan::find($id);
        return $data;
    }
}
