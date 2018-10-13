
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('vehicles.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($vehicle)->name) }}" minlength="1" maxlength="255" required="true">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('size_id') ? 'has-error' : '' }}">
    <label for="size_id" class="col-md-2 control-label">{{ trans('vehicles.size_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="size_id" name="size_id" required="true">
        	    <option value="" style="display: none;" {{ old('size_id', optional($vehicle)->size_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a size</option>
        	@foreach ($sizes as $key => $size)
			    <option value="{{ $key }}" {{ old('size_id', optional($vehicle)->size_id) == $key ? 'selected' : '' }}>
			    	{{ $size }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('size_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('brand_id') ? 'has-error' : '' }}">
    <label for="brand_id" class="col-md-2 control-label">{{ trans('vehicles.brand_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="brand_id" name="brand_id" required="true">
        	    <option value="" style="display: none;" {{ old('brand_id', optional($vehicle)->brand_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a brand</option>
        	@foreach ($brands as $key => $brand)
			    <option value="{{ $key }}" {{ old('brand_id', optional($vehicle)->brand_id) == $key ? 'selected' : '' }}>
			    	{{ $brand }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('brand_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
    <label for="model" class="col-md-2 control-label">{{ trans('vehicles.model') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="model" type="text" id="model" value="{{ old('model', optional($vehicle)->model) }}" maxlength="255">
        {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
    <label for="year" class="col-md-2 control-label">{{ trans('vehicles.year') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="year" type="number" id="year" value="{{ old('year', optional($vehicle)->year) }}" min="-32768" max="32767">
        {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('color') ? 'has-error' : '' }}">
    <label for="color" class="col-md-2 control-label">{{ trans('vehicles.color') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="color" type="text" id="color" value="{{ old('color', optional($vehicle)->color) }}">
        {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('last_oil_change') ? 'has-error' : '' }}">
    <label for="last_oil_change" class="col-md-2 control-label">{{ trans('vehicles.last_oil_change') }}</label>
    <div class="col-md-10">
        <input class="form-control datetime-picker" name="last_oil_change" type="text" id="last_oil_change" value="{{ old('last_oil_change', optional($vehicle)->last_oil_change) }}" required="true">
        {!! $errors->first('last_oil_change', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('miles_to_oil_change') ? 'has-error' : '' }}">
    <label for="miles_to_oil_change" class="col-md-2 control-label">{{ trans('vehicles.miles_to_oil_change') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="miles_to_oil_change" type="number" id="miles_to_oil_change" value="{{ old('miles_to_oil_change', optional($vehicle)->miles_to_oil_change) }}" min="-2147483648" max="2147483647">
        {!! $errors->first('miles_to_oil_change', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('current_miles') ? 'has-error' : '' }}">
    <label for="current_miles" class="col-md-2 control-label">{{ trans('vehicles.current_miles') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="current_miles" type="number" id="current_miles" value="{{ old('current_miles', optional($vehicle)->current_miles) }}" min="-2147483648" max="2147483647">
        {!! $errors->first('current_miles', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('registration_experation_on') ? 'has-error' : '' }}">
    <label for="registration_experation_on" class="col-md-2 control-label">{{ trans('vehicles.registration_experation_on') }}</label>
    <div class="col-md-10">
        <input class="form-control datetime-picker" name="registration_experation_on" type="text" id="registration_experation_on" value="{{ old('registration_experation_on', optional($vehicle)->registration_experation_on) }}" required="true">
        {!! $errors->first('registration_experation_on', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('insurance_experation_on') ? 'has-error' : '' }}">
    <label for="insurance_experation_on" class="col-md-2 control-label">{{ trans('vehicles.insurance_experation_on') }}</label>
    <div class="col-md-10">
        <input class="form-control datetime-picker" name="insurance_experation_on" type="text" id="insurance_experation_on" value="{{ old('insurance_experation_on', optional($vehicle)->insurance_experation_on) }}" required="true">
        {!! $errors->first('insurance_experation_on', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('daily_rate') ? 'has-error' : '' }}">
    <label for="daily_rate" class="col-md-2 control-label">{{ trans('vehicles.daily_rate') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="daily_rate" type="number" id="daily_rate" value="{{ old('daily_rate', optional($vehicle)->daily_rate) }}" min="0" max="9999999" required="true" step="any">
        {!! $errors->first('daily_rate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('weekly_rate') ? 'has-error' : '' }}">
    <label for="weekly_rate" class="col-md-2 control-label">{{ trans('vehicles.weekly_rate') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="weekly_rate" type="number" id="weekly_rate" value="{{ old('weekly_rate', optional($vehicle)->weekly_rate) }}" min="0" max="9999999" required="true" step="any">
        {!! $errors->first('weekly_rate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('monthly_rate') ? 'has-error' : '' }}">
    <label for="monthly_rate" class="col-md-2 control-label">{{ trans('vehicles.monthly_rate') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="monthly_rate" type="number" id="monthly_rate" value="{{ old('monthly_rate', optional($vehicle)->monthly_rate) }}" min="0" max="9999999" required="true" step="any">
        {!! $errors->first('monthly_rate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
    <label for="is_active" class="col-md-2 control-label">{{ trans('vehicles.is_active') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_active_1">
            	<input id="is_active_1" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($vehicle)->is_active ?: '1') == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('vin_number') ? 'has-error' : '' }}">
    <label for="vin_number" class="col-md-2 control-label">{{ trans('vehicles.vin_number') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="vin_number" type="text" id="vin_number" value="{{ old('vin_number', optional($vehicle)->vin_number) }}" minlength="1" maxlength="60" required="true">
        {!! $errors->first('vin_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('licence_plate') ? 'has-error' : '' }}">
    <label for="licence_plate" class="col-md-2 control-label">{{ trans('vehicles.licence_plate') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="licence_plate" type="text" id="licence_plate" value="{{ old('licence_plate', optional($vehicle)->licence_plate) }}" minlength="1" maxlength="30" required="true">
        {!! $errors->first('licence_plate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('purchase_cost') ? 'has-error' : '' }}">
    <label for="purchase_cost" class="col-md-2 control-label">{{ trans('vehicles.purchase_cost') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="purchase_cost" type="number" id="purchase_cost" value="{{ old('purchase_cost', optional($vehicle)->purchase_cost) }}" min="-9999999" max="9999999" step="any">
        {!! $errors->first('purchase_cost', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('purchased_date') ? 'has-error' : '' }}">
    <label for="purchased_date" class="col-md-2 control-label">Purchased Date</label>
    <div class="col-md-10">
        <input class="form-control date-picker" name="purchased_date" type="text" id="purchased_date" value="{{ old('purchased_date', optional($vehicle)->purchased_date) }}" placeholder="Enter purchased date here...">
        {!! $errors->first('purchased_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('sold_date') ? 'has-error' : '' }}">
    <label for="sold_date" class="col-md-2 control-label">Sold Date</label>
    <div class="col-md-10">
        <input class="form-control date-picker" name="sold_date" type="text" id="sold_date" value="{{ old('sold_date', optional($vehicle)->sold_date) }}" placeholder="Enter sold date here...">
        {!! $errors->first('sold_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('sold_amount') ? 'has-error' : '' }}">
    <label for="sold_amount" class="col-md-2 control-label">Sold Amount</label>
    <div class="col-md-10">
        <input class="form-control" name="sold_amount" type="text" id="sold_amount" value="{{ old('sold_amount', optional($vehicle)->sold_amount) }}" minlength="1" placeholder="Enter sold amount here...">
        {!! $errors->first('sold_amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

