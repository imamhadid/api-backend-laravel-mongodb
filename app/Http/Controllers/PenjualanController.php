<?php

namespace App\Http\Controllers;

use App\Services\PenjualanService;

class PenjualanController extends Controller
{
    protected $penjualanService;

    public function __construct(PenjualanService $penjualanService)
    {
        $this->penjualanService = $penjualanService;
    }

    public function getAllTransaksiPenjualan()
    {
        $transaksiPenjualan = $this->penjualanService->getAllTransaksiPenjualan();

        return response()->json([
            'statusCode' => 200,
            'data' => $transaksiPenjualan
        ], 200);
    }

    public function getTransaksiPenjualan($id)
    {
        $transaksiPenjualan = $this->penjualanService->getTransaksiPenjualan($id);

        return response()->json([
            'statusCode' => 200,
            'data' => $transaksiPenjualan
        ], 200);
    }
}
