
<div class="form-group {{ $errors->has('primary_driver_id') ? 'has-error' : '' }}">
    <label for="primary_driver_id" class="col-md-2 control-label">{{ trans('reservations.primary_driver_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="primary_driver_id" name="primary_driver_id" required="true">
        	    <option value="" style="display: none;" {{ old('primary_driver_id', optional($reservation)->primary_driver_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a driver</option>
        	@foreach ($primaryDrivers as $key => $primaryDriver)
			    <option value="{{ $key }}" {{ old('primary_driver_id', optional($reservation)->primary_driver_id) == $key ? 'selected' : '' }}>
			    	{{ $primaryDriver }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('primary_driver_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('vehicle_id') ? 'has-error' : '' }}">
    <label for="vehicle_id" class="col-md-2 control-label">{{ trans('reservations.vehicle_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="vehicle_id" name="vehicle_id" required="true">
        	    <option value="" style="display: none;" {{ old('vehicle_id', optional($reservation)->vehicle_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a vehicle</option>
        	@foreach ($vehicles as $key => $vehicle)
			    <option value="{{ $key }}" {{ old('vehicle_id', optional($reservation)->vehicle_id) == $key ? 'selected' : '' }}>
			    	{{ $vehicle }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('vehicle_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group selected-vehicle hidden {{ $errors->has('reserved_from') ? 'has-error' : '' }}">
    <label for="reserved_from" class="col-md-2 control-label">{{ trans('reservations.reserved_from') }}</label>
    <div class="col-md-10">
        <input class="form-control date-from" name="reserved_from" type="text" id="reserved_from" value="{{ old('reserved_from', optional($reservation)->reserved_from) }}" required="true">
        {!! $errors->first('reserved_from', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group selected-vehicle hidden {{ $errors->has('reserved_to') ? 'has-error' : '' }}">
    <label for="reserved_to" class="col-md-2 control-label">{{ trans('reservations.reserved_to') }}</label>
    <div class="col-md-10">
        <input class="form-control date-to" name="reserved_to" type="text" id="reserved_to" value="{{ old('reserved_to', optional($reservation)->reserved_to) }}" required="true">
        {!! $errors->first('reserved_to', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group selected-data-range hidden {{ $errors->has('total_days') ? 'has-error' : '' }}">
    <label for="total_days" class="col-md-2 control-label">{{ trans('reservations.total_days') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="total_days" type="text" id="total_days" value="{{ old('total_days', optional($reservation)->total_days) }}">
        {!! $errors->first('total_days', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group selected-data-range hidden {{ $errors->has('total_rent') ? 'has-error' : '' }}">
    <label for="total_rent" class="col-md-2 control-label">{{ trans('reservations.total_rent') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="total_rent" type="text" id="total_rent" value="{{ old('total_rent', optional($reservation)->total_rent) }}" min="-9999999" max="9999999" required="true" step="any">
        {!! $errors->first('total_rent', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group selected-data-range hidden {{ $errors->has('total_override') ? 'has-error' : '' }}">
    <label for="total_override" class="col-md-2 control-label">{{ trans('reservations.total_override') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="total_override" type="number" id="total_override" value="{{ old('total_override', optional($reservation)->total_override) }}" min="-9999999" max="9999999" step="any">
        {!! $errors->first('total_override', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group selected-data-range hidden {{ $errors->has('total_tax') ? 'has-error' : '' }}">
    <label for="total_tax" class="col-md-2 control-label">{{ trans('reservations.total_tax') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="total_tax" type="text" id="total_tax" value="{{ old('total_tax', optional($reservation)->total_tax) }}" >
        {!! $errors->first('total_tax', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group selected-data-range hidden {{ $errors->has('total_owe') ? 'has-error' : '' }}">
    <label for="total_owe" class="col-md-2 control-label">{{ trans('reservations.total_owe') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="total_owe" type="text" id="total_owe" value="{{ old('total_owe', optional($reservation)->total_rent) }}" min="-9999999" max="9999999" step="any">
        {!! $errors->first('total_owe', '<p class="help-block">:message</p>') !!}
    </div>
</div>
