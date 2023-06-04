<?php

namespace App\Services;

use App\Repositories\PenjualanRepositoryInterface;

class PenjualanService
{
    protected $penjualanRepository;

    public function __construct(PenjualanRepositoryInterface $penjualanRepository)
    {
        $this->penjualanRepository = $penjualanRepository;
    }

    public function getAllTransaksiPenjualan()
    {
        return $this->penjualanRepository->getAll();
    }

    public function getTransaksiPenjualan($id)
    {
        return $this->penjualanRepository->getById($id);
    }
}
