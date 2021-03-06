
<div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
    <label for="fullname" class="col-md-3 control-label">{{ trans('customers.fullname') }}</label>
    <div class="col-md-9">
        <input class="form-control" name="fullname" type="text" id="fullname" value="{{ old('fullname', optional($customer)->fullname) }}" minlength="1" maxlength="255" required="true">
        {!! $errors->first('fullname', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('personal_identification_number') ? 'has-error' : '' }}">
    <label for="personal_identification_number" class="col-md-3 control-label">{{ trans('customers.personal_identification_number') }}</label>
    <div class="col-md-9">
        <input class="form-control" name="personal_identification_number" type="text" id="personal_identification_number" value="{{ old('personal_identification_number', optional($customer)->personal_identification_number) }}" minlength="1" maxlength="30" required="true">
        {!! $errors->first('personal_identification_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('driver_license_number') ? 'has-error' : '' }}">
    <label for="driver_license_number" class="col-md-3 control-label">{{ trans('customers.driver_license_number') }}</label>
    <div class="col-md-9">
        <input class="form-control" name="driver_license_number" type="text" id="driver_license_number" value="{{ old('driver_license_number', optional($customer)->driver_license_number) }}" minlength="1" maxlength="30" required="true">
        {!! $errors->first('driver_license_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('birth_date') ? 'has-error' : '' }}">
    <label for="birth_date" class="col-md-3 control-label">{{ trans('customers.birth_date') }}</label>
    <div class="col-md-9">
        <input class="form-control date-picker" name="birth_date" type="text" id="birth_date" value="{{ old('birth_date', optional($customer)->birth_date) }}" required="true">
        {!! $errors->first('birth_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('driver_license_issue_date') ? 'has-error' : '' }}">
    <label for="driver_license_issue_date" class="col-md-3 control-label">{{ trans('customers.driver_license_issue_date') }}</label>
    <div class="col-md-9">
        <input class="form-control date-picker" name="driver_license_issue_date" type="text" id="driver_license_issue_date" value="{{ old('driver_license_issue_date', optional($customer)->driver_license_issue_date) }}" required="true">
        {!! $errors->first('driver_license_issue_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('driver_license_experation_date') ? 'has-error' : '' }}">
    <label for="driver_license_experation_date" class="col-md-3 control-label">{{ trans('customers.driver_license_experation_date') }}</label>
    <div class="col-md-9">
        <input class="form-control date-picker" name="driver_license_experation_date" type="text" id="driver_license_experation_date" value="{{ old('driver_license_experation_date', optional($customer)->driver_license_experation_date) }}" required="true">
        {!! $errors->first('driver_license_experation_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
    <label for="phone" class="col-md-3 control-label">{{ trans('customers.phone') }}</label>
    <div class="col-md-9">
        <input class="form-control" name="phone" type="text" id="phone" value="{{ old('phone', optional($customer)->phone) }}" minlength="1" maxlength="30" required="true">
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('home_address') ? 'has-error' : '' }}">
    <label for="home_address" class="col-md-3 control-label">{{ trans('customers.home_address') }}</label>
    <div class="col-md-9">
        <textarea class="form-control" name="home_address" id="home_address" maxlength="500">{{ old('home_address', optional($customer)->home_address) }}</textarea>
        {!! $errors->first('home_address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
