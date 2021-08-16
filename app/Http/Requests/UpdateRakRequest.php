<?php

namespace App\Http\Requests;

use App\Models\Rak;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRakRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rak_edit');
    }

    public function rules()
    {
        return [
            'nomor' => [
                'string',
                'required',
                'unique:raks,nomor,' . request()->route('rak')->id,
            ],
        ];
    }
}
