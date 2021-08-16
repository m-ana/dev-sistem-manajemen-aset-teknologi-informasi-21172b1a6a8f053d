<?php

namespace App\Http\Requests;

use App\Models\Merk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMerkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('merk_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'max:50',
                'required',
            ],
        ];
    }
}
