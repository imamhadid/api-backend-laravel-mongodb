<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use App\Repositories\PenjualanRepositoryInterface;

class KendaraanService
{
    private $kendaraanRepository;
    protected $penjualanRepository;

    public function __construct(
        KendaraanRepository $kendaraanRepository,
        PenjualanRepositoryInterface $penjualanRepository
    ) {
        $this->kendaraanRepository = $kendaraanRepository;
        $this->penjualanRepository = $penjualanRepository;
    }

    public function beliKendaraan($id_kendaraan, $id_pembeli)
    {
        $kendaraan = $this->kendaraanRepository->getKendaraanById($id_kendaraan);


        if ($kendaraan && $kendaraan->status === 'ready') {
            $kendaraan->status = 'sold';
            $kendaraan->save();

            $data = [
                'id_kendaraan' => $id_kendaraan,
                'id_pembeli' => $id_pembeli,
            ];

            $penjualan = $this->penjualanRepository->create($data);

            return $penjualan;
        } else {
            return null;
        }
    }

    public function createMobil(array $data)
    {
        return $this->kendaraanRepository->createMobil($data);
    }

    public function createMotor(array $data)
    {
        return $this->kendaraanRepository->createMotor($data);
    }

    public function getKendaraanByFilters(array $filters)
    {
        return $this->kendaraanRepository->getByFilters($filters);
    }

    public function getKendaraanById($id)
    {
        return $this->kendaraanRepository->getKendaraanById($id);
    }
}
