<?php

namespace App\Http\Requests;

use App\Models\Membership;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMembershipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('membership_edit');
    }

    public function rules()
    {
        return [
            'member_status' => [
                'string',
                'nullable',
            ],
            'member_reference' => [
                'string',
                'required',
                'unique:memberships,member_reference,' . request()->route('membership')->id,
            ],
            'member_class' => [
                'string',
                'nullable',
            ],
            'member_name' => [
                'string',
                'nullable',
            ],
            'date_awarded' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'membership_validity' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'awarding_body' => [
                'string',
                'nullable',
            ],
            'training_credits' => [
                'string',
                'nullable',
            ],
            'support_funds' => [
                'string',
                'nullable',
            ],
            'digital_member_card' => [
                'string',
                'nullable',
            ],
        ];
    }
}
