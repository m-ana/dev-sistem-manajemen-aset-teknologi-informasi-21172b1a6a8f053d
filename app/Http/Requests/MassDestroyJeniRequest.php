<?php

namespace App\Http\Requests;

use App\Models\Jeni;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyJeniRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('jeni_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:jenis,id',
        ];
    }
}
