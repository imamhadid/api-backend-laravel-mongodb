<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\KendaraanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\PenjualanRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    private $kendaraanService;
    protected $penjualanRepository;

    public function __construct(
        KendaraanService $kendaraanService,
        PenjualanRepositoryInterface $penjualanRepository
    ) {
        $this->kendaraanService = $kendaraanService;
        $this->penjualanRepository = $penjualanRepository;
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'jenis_kendaraan',
            'tahun_kendaraan',
            'warna',
            'harga_min',
            'harga_max',
            'mesin',
            'tipe_suspensi',
            'tipe_transmisi',
            'kapasitas_penumpang',
            'tipe'
        ]);
        $kendaraan = $this->kendaraanService->getKendaraanByFilters($filters);
        return response()->json([
            'statusCode' => 200,
            'data' => $kendaraan
        ], 200);
    }

    public function store(Request $request, $type)
    {
        $rules = [
            'nama' => 'required|string',
            'tahun_kendaraan' => 'required|integer',
            'warna' => 'required|string',
            'harga' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 400,
                'error' => $validator->errors()
            ], 400);
        }

        $data = $request->only(['warna', 'harga', 'tahun_kendaraan']);
        $data['jenis_kendaraan'] = $type;

        if ($type === 'mobil') {
            $data['mesin'] = $request->input('mesin');
            $data['kapasitas_penumpang'] = $request->input('kapasitas_penumpang');
            $data['tipe'] = $request->input('tipe');
        } else if ($type === 'motor') {
            $data['mesin'] = $request->input('mesin');
            $data['tipe_suspensi'] = $request->input('tipe_suspensi');
            $data['tipe_transmisi'] = $request->input('tipe_transmisi');
        } else {
            return response()->json([
                'statusCode' => 400,
                'message' => 'URL tidak dikenal'
            ], 400);
        }

        $kendaraan = ($type === 'mobil') ? $this->kendaraanService->createMobil($data) : $this->kendaraanService->createMotor($data);


        return response()->json([
            'statusCode' => 201,
            'data' => $kendaraan
        ], 201);
    }

    public function show($id)
    {
        $kendaraan = $this->kendaraanService->getKendaraanById($id);


        return response()->json([
            'statusCode' => 200,
            'data' => $kendaraan
        ], 200);
    }

    public function beliKendaraan(Request $request)
    {
        $id_kendaraan = $request->input('id_kendaraan');

        $id_pembeli = Auth::user()->id;


        $penjualan = $this->kendaraanService->beliKendaraan($id_kendaraan, $id_pembeli);

        if($penjualan == null) {
            return response()->json([
                'statusCode' => 400,
                'message' => 'Kendaraan has sold'
            ], 400);
        }
        return response()->json([
            'statusCode' => 201,
            'data' => $penjualan
        ], 201);

    }
}
