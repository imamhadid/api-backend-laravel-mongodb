<?php

namespace App\Repositories;

use App\Models\Penjualan;

class PenjualanRepository implements PenjualanRepositoryInterface
{
    public function getAllTransaksiPenjualan()
    {
        $data = Penjualan::all();
        return $data;
    }

    public function create(array $data)
    {
        return Penjualan::create($data);
    }

    public function getAll()
    {
        $query = Penjualan::query();

        if (request()->has('tahun_kendaraan')) {
            $tahunKendaraan = request('tahun_kendaraan');
            $query->whereHas('kendaraan', function ($q) use ($tahunKendaraan) {
                $q->where('tahun_kendaraan', $tahunKendaraan);
            });
        }

        if (request()->has('warna')) {
            $warna = request('warna');
            $query->whereHas('kendaraan', function ($q) use ($warna) {
                $q->where('warna', $warna);
            });
        }

        if (request()->has('harga')) {
            $harga = request('harga');
            $query->whereHas('kendaraan', function ($q) use ($harga) {
                $q->where('harga', $harga);
            });
        }

        if (request()->has('jenis_kendaraan')) {
            $jenisKendaraan = request('jenis_kendaraan');
            $query->whereHas('kendaraan', function ($q) use ($jenisKendaraan) {
                $q->where('jenis_kendaraan', $jenisKendaraan);
            });
        }

        if (request()->has('kapasitas_penumpang')) {
            $kapasitasPenumpang = request('kapasitas_penumpang');
            $query->whereHas('kendaraan', function ($q) use ($kapasitasPenumpang) {
                $q->where('kapasitas_penumpang', $kapasitasPenumpang);
            });
        }

        if (request()->has('nama')) {
            $nama = request('nama');
            $query->whereHas('user', function ($q) use ($nama) {
                $q->where('nama', $nama);
            });
        }

        return $query->paginate(10);
    }

    public function getById($id)
    {
        return Penjualan::with('user', 'kendaraan')->find($id);
    }
}
