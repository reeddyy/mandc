@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ada.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.adas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ada.fields.id') }}
                        </th>
                        <td>
                            {{ $ada->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ada.fields.member_name') }}
                        </th>
                        <td>
                            {{ $ada->member_name->member_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ada.fields.award_name') }}
                        </th>
                        <td>
                            {{ $ada->award_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ada.fields.date_awarded') }}
                        </th>
                        <td>
                            {{ $ada->date_awarded }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ada.fields.award_validity') }}
                        </th>
                        <td>
                            {{ $ada->award_validity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ada.fields.awarding_body') }}
                        </th>
                        <td>
                            {{ $ada->awarding_body }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ada.fields.award_status') }}
                        </th>
                        <td>
                            {{ $ada->award_status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ada.fields.note') }}
                        </th>
                        <td>
                            {{ $ada->note }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.adas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection