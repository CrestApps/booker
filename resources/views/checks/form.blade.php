
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : '' }}">
    <label for="customer_id" class="col-md-2 control-label">{{ trans('checks.customer_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="customer_id" name="customer_id" required="true">
        	    <option value="" style="display: none;" {{ old('customer_id', optional($check)->customer_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a customer</option>
        	@foreach ($customers as $key => $customer)
			    <option value="{{ $key }}" {{ old('customer_id', optional($check)->customer_id) == $key ? 'selected' : '' }}>
			    	{{ $customer }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('total') ? 'has-error' : '' }}">
    <label for="total" class="col-md-2 control-label">{{ trans('checks.total') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="total" type="number" id="total" value="{{ old('total', optional($check)->total) }}" min="-9999999" max="9999999" required="true" step="any">
        {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('due_date') ? 'has-error' : '' }}">
    <label for="due_date" class="col-md-2 control-label">{{ trans('checks.due_date') }}</label>
    <div class="col-md-10">
        <input class="form-control date-picker" name="due_date" type="text" id="due_date" value="{{ old('due_date', optional($check)->due_date) }}" required="true">
        {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">{{ trans('checks.status') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="status" type="text" id="status" value="{{ old('status', optional($check)->status) }}" minlength="1" required="true">
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('reservation_id') ? 'has-error' : '' }}">
    <label for="reservation_id" class="col-md-2 control-label">Reservation</label>
    <div class="col-md-10">
        <select class="form-control" id="reservation_id" name="reservation_id">
        	    <option value="" style="display: none;" {{ old('reservation_id', optional($check)->reservation_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select reservation</option>
        	@foreach ($reservations as $key => $reservation)
			    <option value="{{ $key }}" {{ old('reservation_id', optional($check)->reservation_id) == $key ? 'selected' : '' }}>
			    	{{ $reservation }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('reservation_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

