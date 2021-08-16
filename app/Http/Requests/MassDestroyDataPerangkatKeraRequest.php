<?php

namespace App\Http\Requests;

use App\Models\DataPerangkatKera;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDataPerangkatKeraRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('data_perangkat_kera_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:data_perangkat_keras,id',
        ];
    }
}
