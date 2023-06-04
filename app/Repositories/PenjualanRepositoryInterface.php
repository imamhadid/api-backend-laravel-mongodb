<?php

namespace App\Repositories;

use App\Models\Penjualan;

interface PenjualanRepositoryInterface
{
    public function getAllTransaksiPenjualan();
    public function create(array $data);

    public function getAll();
    public function getById($id);
}
