<?php

namespace App\Http\Requests;

use App\Models\DataPerangkatKera;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataPerangkatKeraRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_perangkat_kera_create');
    }

    public function rules()
    {
        return [
            'nomor_rak_id' => [
                'required',
                'integer',
            ],
            'nama_merk_id' => [
                'required',
                'integer',
            ],
            'tipe' => [
                'string',
                'nullable',
            ],
            'serial_number' => [
                'string',
                'nullable',
            ],
            'tahun_beli' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'nomor_u' => [
                'string',
                'nullable',
            ],
            'ip' => [
                'string',
                'nullable',
            ],
            'tahun_berakhir_garansi' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'nomor_u_kosong' => [
                'string',
                'nullable',
            ],
            'kontak_pic' => [
                'string',
                'nullable',
            ],
            'ruang_panel' => [
                'string',
                'max:50',
                'nullable',
            ],
        ];
    }
}
