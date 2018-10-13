
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
    <label for="category_id" class="col-md-2 control-label">{{ trans('expenses.category_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="category_id" name="category_id" required="true">
        	    <option value="" style="display: none;" {{ old('category_id', optional($expense)->category_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a category</option>
        	@foreach ($categories as $key => $category)
			    <option value="{{ $key }}" {{ old('category_id', optional($expense)->category_id) == $key ? 'selected' : '' }}>
			    	{{ $category }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('related_date') ? 'has-error' : '' }}">
    <label for="related_date" class="col-md-2 control-label">{{ trans('expenses.related_date') }}</label>
    <div class="col-md-10">
        <input class="form-control month-picker" name="related_date" type="text" id="related_date" value="{{ old('related_date', optional($expense)->related_date) }}" required="true">
        {!! $errors->first('related_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
    <label for="amount" class="col-md-2 control-label">{{ trans('expenses.amount') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="amount" type="number" id="amount" value="{{ old('amount', optional($expense)->amount) }}" min="0" max="9999999" required="true" step="any">
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pay_date') ? 'has-error' : '' }}">
    <label for="pay_date" class="col-md-2 control-label">Pay Date</label>
    <div class="col-md-10">
        <input class="form-control date-picker" name="pay_date" type="text" id="pay_date" value="{{ old('pay_date', optional($expense)->pay_date) }}" required="true" placeholder="Enter pay date here...">
        {!! $errors->first('pay_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
    <label for="notes" class="col-md-2 control-label">{{ trans('expenses.notes') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="notes" cols="50" rows="10" id="notes" maxlength="1000">{{ old('notes', optional($expense)->notes) }}</textarea>
        {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
    </div>
</div>

