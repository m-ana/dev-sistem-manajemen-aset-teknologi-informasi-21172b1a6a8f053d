<?php

namespace App\Http\Requests;

use App\Models\Rak;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRakRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rak_create');
    }

    public function rules()
    {
        return [
            'nomor' => [
                'string',
                'required',
                'unique:raks',
            ],
        ];
    }
}
