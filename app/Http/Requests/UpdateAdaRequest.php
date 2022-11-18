<?php

namespace App\Http\Requests;

use App\Models\Ada;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAdaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ada_edit');
    }

    public function rules()
    {
        return [
            'member_reference' => [
                'string',
                'nullable',
            ],
            'member_name' => [
                'string',
                'nullable',
            ],
            'award_name' => [
                'string',
                'nullable',
            ],
            'date_awarded' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'award_validity' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'awarding_body' => [
                'string',
                'nullable',
            ],
            'award_reference' => [
                'string',
                'nullable',
            ],
            'award_status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
