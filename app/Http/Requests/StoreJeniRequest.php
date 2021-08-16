<?php

namespace App\Http\Requests;

use App\Models\Jeni;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJeniRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('jeni_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'max:50',
                'nullable',
            ],
        ];
    }
}
