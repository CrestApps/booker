
<div class="form-group {{ $errors->has('reservation_id') ? 'has-error' : '' }}">
    <label for="reservation_id" class="col-md-2 control-label">{{ trans('reservation_drivers.reservation_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="reservation_id" name="reservation_id" required="true">
        	    <option value="" style="display: none;" {{ old('reservation_id', optional($reservationDriver)->reservation_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a reservation</option>
        	@foreach ($reservations as $key => $reservation)
			    <option value="{{ $key }}" {{ old('reservation_id', optional($reservationDriver)->reservation_id) == $key ? 'selected' : '' }}>
			    	{{ $reservation }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('reservation_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('driver_id') ? 'has-error' : '' }}">
    <label for="driver_id" class="col-md-2 control-label">{{ trans('reservation_drivers.driver_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="driver_id" name="driver_id" required="true">
        	    <option value="" style="display: none;" {{ old('driver_id', optional($reservationDriver)->driver_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a driver</option>
        	@foreach ($drivers as $key => $driver)
			    <option value="{{ $key }}" {{ old('driver_id', optional($reservationDriver)->driver_id) == $key ? 'selected' : '' }}>
			    	{{ $driver }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('driver_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

