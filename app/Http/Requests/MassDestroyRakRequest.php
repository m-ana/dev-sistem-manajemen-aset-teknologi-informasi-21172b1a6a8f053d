<?php

namespace App\Http\Requests;

use App\Models\Rak;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRakRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rak_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:raks,id',
        ];
    }
}
