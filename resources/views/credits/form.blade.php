
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : '' }}">
    <label for="customer_id" class="col-md-2 control-label">{{ trans('credits.customer_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="customer_id" name="customer_id" required="true">
        	    <option value="" style="display: none;" {{ old('customer_id', optional($credit)->customer_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a customer</option>
        	@foreach ($customers as $key => $customer)
			    <option value="{{ $key }}" {{ old('customer_id', optional($credit)->customer_id) == $key ? 'selected' : '' }}>
			    	{{ $customer }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
    <label for="amount" class="col-md-2 control-label">{{ trans('credits.amount') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="amount" type="number" id="amount" value="{{ old('amount', optional($credit)->amount) }}" min="-9999999" max="9999999" required="true" step="any">
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('due_date') ? 'has-error' : '' }}">
    <label for="due_date" class="col-md-2 control-label">{{ trans('credits.due_date') }}</label>
    <div class="col-md-10">
        <input class="form-control date-picker" name="due_date" type="text" id="due_date" value="{{ old('due_date', optional($credit)->due_date) }}" required="true">
        {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

