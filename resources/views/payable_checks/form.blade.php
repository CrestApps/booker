
<div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
    <label for="number" class="col-md-2 control-label">{{ trans('payable_checks.number') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="number" type="number" id="number" value="{{ old('number', optional($payableCheck)->number) }}" min="0" max="2147483647">
        {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
    <label for="value" class="col-md-2 control-label">{{ trans('payable_checks.value') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="value" type="number" id="value" value="{{ old('value', optional($payableCheck)->value) }}" min="1" max="9999999" required="true" step="any">
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('due_date') ? 'has-error' : '' }}">
    <label for="due_date" class="col-md-2 control-label">{{ trans('payable_checks.due_date') }}</label>
    <div class="col-md-10">
        <input class="form-control date-picker" name="due_date" type="text" id="due_date" value="{{ old('due_date', optional($payableCheck)->due_date) }}" required="true">
        {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('issue_date') ? 'has-error' : '' }}">
    <label for="issue_date" class="col-md-2 control-label">{{ trans('payable_checks.issue_date') }}</label>
    <div class="col-md-10">
        <input class="form-control date-picker" name="issue_date" type="text" id="issue_date" value="{{ old('issue_date', optional($payableCheck)->issue_date) }}" required="true">
        {!! $errors->first('issue_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('expense_id') ? 'has-error' : '' }}">
    <label for="expense_id" class="col-md-2 control-label">{{ trans('payable_checks.expense_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="expense_id" name="expense_id" required="true">
        	    <option value="" style="display: none;" {{ old('expense_id', optional($payableCheck)->expense_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a expense</option>
        	@foreach ($expenses as $key => $expense)
			    <option value="{{ $key }}" {{ old('expense_id', optional($payableCheck)->expense_id) == $key ? 'selected' : '' }}>
			    	{{ $expense }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('expense_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_cashed') ? 'has-error' : '' }}">
    <label for="is_cashed" class="col-md-2 control-label">{{ trans('payable_checks.is_cashed') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_cashed_1">
            	<input id="is_cashed_1" class="" name="is_cashed" type="checkbox" value="1" {{ old('is_cashed', optional($payableCheck)->is_cashed) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_cashed', '<p class="help-block">:message</p>') !!}
    </div>
</div>

