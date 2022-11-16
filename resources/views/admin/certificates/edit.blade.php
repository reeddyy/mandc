@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.certificate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.certificates.update", [$certificate->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="credential_reference">{{ trans('cruds.certificate.fields.credential_reference') }}</label>
                <input class="form-control {{ $errors->has('credential_reference') ? 'is-invalid' : '' }}" type="text" name="credential_reference" id="credential_reference" value="{{ old('credential_reference', $certificate->credential_reference) }}" required>
                @if($errors->has('credential_reference'))
                    <div class="invalid-feedback">
                        {{ $errors->first('credential_reference') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.credential_reference_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_awarded">{{ trans('cruds.certificate.fields.date_awarded') }}</label>
                <input class="form-control date {{ $errors->has('date_awarded') ? 'is-invalid' : '' }}" type="text" name="date_awarded" id="date_awarded" value="{{ old('date_awarded', $certificate->date_awarded) }}">
                @if($errors->has('date_awarded'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_awarded') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.date_awarded_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="recipient_name">{{ trans('cruds.certificate.fields.recipient_name') }}</label>
                <input class="form-control {{ $errors->has('recipient_name') ? 'is-invalid' : '' }}" type="text" name="recipient_name" id="recipient_name" value="{{ old('recipient_name', $certificate->recipient_name) }}">
                @if($errors->has('recipient_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('recipient_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.recipient_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="credential_title">{{ trans('cruds.certificate.fields.credential_title') }}</label>
                <input class="form-control {{ $errors->has('credential_title') ? 'is-invalid' : '' }}" type="text" name="credential_title" id="credential_title" value="{{ old('credential_title', $certificate->credential_title) }}">
                @if($errors->has('credential_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('credential_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.credential_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="awarding_body">{{ trans('cruds.certificate.fields.awarding_body') }}</label>
                <input class="form-control {{ $errors->has('awarding_body') ? 'is-invalid' : '' }}" type="text" name="awarding_body" id="awarding_body" value="{{ old('awarding_body', $certificate->awarding_body) }}">
                @if($errors->has('awarding_body'))
                    <div class="invalid-feedback">
                        {{ $errors->first('awarding_body') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.awarding_body_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.certificate.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note', $certificate->note) }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.note_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection