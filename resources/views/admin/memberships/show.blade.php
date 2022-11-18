@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.membership.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.memberships.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.id') }}
                        </th>
                        <td>
                            {{ $membership->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.member_status') }}
                        </th>
                        <td>
                            {{ $membership->member_status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.member_reference') }}
                        </th>
                        <td>
                            {{ $membership->member_reference }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.member_class') }}
                        </th>
                        <td>
                            {{ $membership->member_class }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.member_name') }}
                        </th>
                        <td>
                            {{ $membership->member_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.member_email') }}
                        </th>
                        <td>
                            {{ $membership->member_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.date_awarded') }}
                        </th>
                        <td>
                            {{ $membership->date_awarded }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.membership_validity') }}
                        </th>
                        <td>
                            {{ $membership->membership_validity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.awarding_body') }}
                        </th>
                        <td>
                            {{ $membership->awarding_body }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.training_credits') }}
                        </th>
                        <td>
                            {{ $membership->training_credits }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.support_funds') }}
                        </th>
                        <td>
                            {{ $membership->support_funds }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.digital_member_card') }}
                        </th>
                        <td>
                            {{ $membership->digital_member_card }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.membership.fields.note') }}
                        </th>
                        <td>
                            {{ $membership->note }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.memberships.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection