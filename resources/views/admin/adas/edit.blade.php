@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ada.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.adas.update", [$ada->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="member_name_id">{{ trans('cruds.ada.fields.member_name') }}</label>
                <select class="form-control select2 {{ $errors->has('member_name') ? 'is-invalid' : '' }}" name="member_name_id" id="member_name_id" required>
                    @foreach($member_names as $id => $entry)
                        <option value="{{ $id }}" {{ (old('member_name_id') ? old('member_name_id') : $ada->member_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('member_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ada.fields.member_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="award_name">{{ trans('cruds.ada.fields.award_name') }}</label>
                <input class="form-control {{ $errors->has('award_name') ? 'is-invalid' : '' }}" type="text" name="award_name" id="award_name" value="{{ old('award_name', $ada->award_name) }}">
                @if($errors->has('award_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('award_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ada.fields.award_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_awarded">{{ trans('cruds.ada.fields.date_awarded') }}</label>
                <input class="form-control date {{ $errors->has('date_awarded') ? 'is-invalid' : '' }}" type="text" name="date_awarded" id="date_awarded" value="{{ old('date_awarded', $ada->date_awarded) }}">
                @if($errors->has('date_awarded'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_awarded') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ada.fields.date_awarded_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="award_validity">{{ trans('cruds.ada.fields.award_validity') }}</label>
                <input class="form-control date {{ $errors->has('award_validity') ? 'is-invalid' : '' }}" type="text" name="award_validity" id="award_validity" value="{{ old('award_validity', $ada->award_validity) }}">
                @if($errors->has('award_validity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('award_validity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ada.fields.award_validity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="awarding_body">{{ trans('cruds.ada.fields.awarding_body') }}</label>
                <input class="form-control {{ $errors->has('awarding_body') ? 'is-invalid' : '' }}" type="text" name="awarding_body" id="awarding_body" value="{{ old('awarding_body', $ada->awarding_body) }}">
                @if($errors->has('awarding_body'))
                    <div class="invalid-feedback">
                        {{ $errors->first('awarding_body') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ada.fields.awarding_body_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="award_status">{{ trans('cruds.ada.fields.award_status') }}</label>
                <input class="form-control {{ $errors->has('award_status') ? 'is-invalid' : '' }}" type="text" name="award_status" id="award_status" value="{{ old('award_status', $ada->award_status) }}">
                @if($errors->has('award_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('award_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ada.fields.award_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.ada.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note', $ada->note) }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ada.fields.note_helper') }}</span>
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