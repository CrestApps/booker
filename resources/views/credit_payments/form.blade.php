
<div class="form-group {{ $errors->has('credit_id') ? 'has-error' : '' }}">
    <label for="credit_id" class="col-md-2 control-label">{{ trans('credit_payments.credit_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="credit_id" name="credit_id" required="true">
        	    <option value="" style="display: none;" {{ old('credit_id', optional($creditPayment)->credit_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a credit</option>
        	@foreach ($credits as $key => $credit)
			    <option value="{{ $key }}" {{ old('credit_id', optional($creditPayment)->credit_id) == $key ? 'selected' : '' }}>
			    	{{ $credit }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('credit_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
    <label for="amount" class="col-md-2 control-label">{{ trans('credit_payments.amount') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="amount" type="number" id="amount" value="{{ old('amount', optional($creditPayment)->amount) }}" min="-9999999" max="9999999" required="true" step="any">
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
    <label for="payment_method" class="col-md-2 control-label">Payment Method</label>
    <div class="col-md-10">
        <input class="form-control" name="payment_method" type="text" id="payment_method" value="{{ old('payment_method', optional($creditPayment)->payment_method) }}" minlength="1" placeholder="Enter payment method here...">
        {!! $errors->first('payment_method', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('check_id') ? 'has-error' : '' }}">
    <label for="check_id" class="col-md-2 control-label">Check</label>
    <div class="col-md-10">
        <select class="form-control" id="check_id" name="check_id">
        	    <option value="" style="display: none;" {{ old('check_id', optional($creditPayment)->check_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select check</option>
        	@foreach ($checks as $key => $check)
			    <option value="{{ $key }}" {{ old('check_id', optional($creditPayment)->check_id) == $key ? 'selected' : '' }}>
			    	{{ $check }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('check_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

