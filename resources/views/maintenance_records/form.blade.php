
<div class="form-group {{ $errors->has('vehicle_id') ? 'has-error' : '' }}">
    <label for="vehicle_id" class="col-md-2 control-label">{{ trans('maintenance_records.vehicle_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="vehicle_id" name="vehicle_id" required="true">
        	    <option value="" style="display: none;" {{ old('vehicle_id', optional($maintenanceRecord)->vehicle_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a vehicle</option>
        	@foreach ($vehicles as $key => $vehicle)
			    <option value="{{ $key }}" {{ old('vehicle_id', optional($maintenanceRecord)->vehicle_id) == $key ? 'selected' : '' }}>
			    	{{ $vehicle }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('vehicle_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('catgeory_id') ? 'has-error' : '' }}">
    <label for="catgeory_id" class="col-md-2 control-label">{{ trans('maintenance_records.catgeory_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="catgeory_id" name="catgeory_id" required="true">
        	    <option value="" style="display: none;" {{ old('catgeory_id', optional($maintenanceRecord)->catgeory_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a catgeory</option>
        	@foreach ($catgeories as $key => $catgeory)
			    <option value="{{ $key }}" {{ old('catgeory_id', optional($maintenanceRecord)->catgeory_id) == $key ? 'selected' : '' }}>
			    	{{ $catgeory }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('catgeory_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
    <label for="cost" class="col-md-2 control-label">{{ trans('maintenance_records.cost') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="cost" type="number" id="cost" value="{{ old('cost', optional($maintenanceRecord)->cost) }}" min="-9999999" max="9999999" step="any">
        {!! $errors->first('cost', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('paid_at') ? 'has-error' : '' }}">
    <label for="paid_at" class="col-md-2 control-label">{{ trans('maintenance_records.paid_at') }}</label>
    <div class="col-md-10">
        <input class="form-control datetime-picker" name="paid_at" type="text" id="paid_at" value="{{ old('paid_at', optional($maintenanceRecord)->paid_at) }}" required="true">
        {!! $errors->first('paid_at', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('related_date') ? 'has-error' : '' }}">
    <label for="related_date" class="col-md-2 control-label">{{ trans('maintenance_records.related_date') }}</label>
    <div class="col-md-10">
        <input class="form-control date-picker" name="related_date" type="text" id="related_date" value="{{ old('related_date', optional($maintenanceRecord)->related_date) }}" required="true">
        {!! $errors->first('related_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
    <label for="notes" class="col-md-2 control-label">{{ trans('maintenance_records.notes') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="notes" cols="50" rows="10" id="notes" maxlength="1000">{{ old('notes', optional($maintenanceRecord)->notes) }}</textarea>
        {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
    </div>
</div>

