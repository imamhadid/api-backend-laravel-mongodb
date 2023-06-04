<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanRequest extends FormRequest
{
    public function rules()
    {
        return [
            'pelanggan' => 'required',
            'detail_penjualan' => 'required|array',
            'detail_penjualan.*.jumlah' => 'required|integer|min:1',
            'detail_penjualan.*.harga' => 'required|numeric|min:0',
        ];
    }
}
