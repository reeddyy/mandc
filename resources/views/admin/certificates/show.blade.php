@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.certificate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.certificates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.id') }}
                        </th>
                        <td>
                            {{ $certificate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.credential_reference') }}
                        </th>
                        <td>
                            {{ $certificate->credential_reference }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.date_awarded') }}
                        </th>
                        <td>
                            {{ $certificate->date_awarded }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.recipient_name') }}
                        </th>
                        <td>
                            {{ $certificate->recipient_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.credential_title') }}
                        </th>
                        <td>
                            {{ $certificate->credential_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.awarding_body') }}
                        </th>
                        <td>
                            {{ $certificate->awarding_body }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.note') }}
                        </th>
                        <td>
                            {{ $certificate->note }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.certificates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
<!-- /.box-footer -->
    <!-- /.box-footer -->
    <div class="form-group">
        <div class="col-sm-12">
            <label class=" control-label" style="float:right"><b>Last Updated By</b>: @if(isset($user->name))
                {{$user->name}} @else {{""}} @endif at
                {{ \Carbon\Carbon::parse($certificate->updated_at)->format('d-M-Y h:i:s A')}}</label>
        </div>
    </div>
</form>


@endsection