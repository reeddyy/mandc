@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.membership.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.memberships.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="member_status">{{ trans('cruds.membership.fields.member_status') }}</label>
                <input class="form-control {{ $errors->has('member_status') ? 'is-invalid' : '' }}" type="text" name="member_status" id="member_status" value="{{ old('member_status', '') }}">
                @if($errors->has('member_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.member_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="member_reference">{{ trans('cruds.membership.fields.member_reference') }}</label>
                <input class="form-control {{ $errors->has('member_reference') ? 'is-invalid' : '' }}" type="text" name="member_reference" id="member_reference" value="{{ old('member_reference', '') }}" required>
                @if($errors->has('member_reference'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_reference') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.member_reference_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="member_class">{{ trans('cruds.membership.fields.member_class') }}</label>
                <input class="form-control {{ $errors->has('member_class') ? 'is-invalid' : '' }}" type="text" name="member_class" id="member_class" value="{{ old('member_class', '') }}">
                @if($errors->has('member_class'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_class') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.member_class_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="member_name">{{ trans('cruds.membership.fields.member_name') }}</label>
                <input class="form-control {{ $errors->has('member_name') ? 'is-invalid' : '' }}" type="text" name="member_name" id="member_name" value="{{ old('member_name', '') }}">
                @if($errors->has('member_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.member_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="member_email">{{ trans('cruds.membership.fields.member_email') }}</label>
                <input class="form-control {{ $errors->has('member_email') ? 'is-invalid' : '' }}" type="email" name="member_email" id="member_email" value="{{ old('member_email') }}">
                @if($errors->has('member_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.member_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_awarded">{{ trans('cruds.membership.fields.date_awarded') }}</label>
                <input class="form-control date {{ $errors->has('date_awarded') ? 'is-invalid' : '' }}" type="text" name="date_awarded" id="date_awarded" value="{{ old('date_awarded') }}">
                @if($errors->has('date_awarded'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_awarded') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.date_awarded_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="membership_validity">{{ trans('cruds.membership.fields.membership_validity') }}</label>
                <input class="form-control date {{ $errors->has('membership_validity') ? 'is-invalid' : '' }}" type="text" name="membership_validity" id="membership_validity" value="{{ old('membership_validity') }}">
                @if($errors->has('membership_validity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('membership_validity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.membership_validity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="awarding_body">{{ trans('cruds.membership.fields.awarding_body') }}</label>
                <input class="form-control {{ $errors->has('awarding_body') ? 'is-invalid' : '' }}" type="text" name="awarding_body" id="awarding_body" value="{{ old('awarding_body', '') }}">
                @if($errors->has('awarding_body'))
                    <div class="invalid-feedback">
                        {{ $errors->first('awarding_body') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.awarding_body_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="training_credits">{{ trans('cruds.membership.fields.training_credits') }}</label>
                <input class="form-control {{ $errors->has('training_credits') ? 'is-invalid' : '' }}" type="text" name="training_credits" id="training_credits" value="{{ old('training_credits', '') }}">
                @if($errors->has('training_credits'))
                    <div class="invalid-feedback">
                        {{ $errors->first('training_credits') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.training_credits_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="support_funds">{{ trans('cruds.membership.fields.support_funds') }}</label>
                <input class="form-control {{ $errors->has('support_funds') ? 'is-invalid' : '' }}" type="text" name="support_funds" id="support_funds" value="{{ old('support_funds', '') }}">
                @if($errors->has('support_funds'))
                    <div class="invalid-feedback">
                        {{ $errors->first('support_funds') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.support_funds_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="digital_member_card">{{ trans('cruds.membership.fields.digital_member_card') }}</label>
                <input class="form-control {{ $errors->has('digital_member_card') ? 'is-invalid' : '' }}" type="text" name="digital_member_card" id="digital_member_card" value="{{ old('digital_member_card', '') }}">
                @if($errors->has('digital_member_card'))
                    <div class="invalid-feedback">
                        {{ $errors->first('digital_member_card') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.digital_member_card_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="note">{{ trans('cruds.membership.fields.note') }}</label>
                <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" name="note" id="note">{{ old('note') }}</textarea>
                @if($errors->has('note'))
                    <div class="invalid-feedback">
                        {{ $errors->first('note') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.note_helper') }}</span>
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