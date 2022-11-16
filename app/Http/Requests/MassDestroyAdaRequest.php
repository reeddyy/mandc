<?php

namespace App\Http\Requests;

use App\Models\Ada;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAdaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ada_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:adas,id',
        ];
    }
}
