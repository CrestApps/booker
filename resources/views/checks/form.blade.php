<div class="form-group mb-0">
    <label for="reservation_id" class="col-md-2 control-label">{{ trans('checks.reservation_id') }}</label>
    <div class="col-md-10 pt-5">
        <p>{{ optional($check)->reservation_id }}</p>
    </div>
</div>



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
        <input class="form-control date-picker" name="due_date" type="text" id="due_date" value="{{ old('due_date', optional(optional($check)->due_date)->format(config('app.date_out_format')) ) }}" required="true">
        {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">{{ trans('checks.status') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="status" name="status" required="true">

        	@foreach (['received' => trans('checks.status_received'),
                       'cleared' => trans('checks.status_cleared'),
                       'bounced' => trans('checks.status_bounced')] as $key => $text)
			    <option value="{{ $key }}" {{ old('status', optional($check)->status) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
