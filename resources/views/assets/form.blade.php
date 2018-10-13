
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('assets.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($asset)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
    <label for="category_id" class="col-md-2 control-label">{{ trans('assets.category_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="category_id" name="category_id" required="true">
        	    <option value="" style="display: none;" {{ old('category_id', optional($asset)->category_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select category</option>
        	@foreach ($categories as $key => $category)
			    <option value="{{ $key }}" {{ old('category_id', optional($asset)->category_id) == $key ? 'selected' : '' }}>
			    	{{ $category }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
    <label for="cost" class="col-md-2 control-label">{{ trans('assets.cost') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="cost" type="number" id="cost" value="{{ old('cost', optional($asset)->cost) }}" min="-9999999" max="9999999" required="true" placeholder="Enter cost here..." step="any">
        {!! $errors->first('cost', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('purchased_at') ? 'has-error' : '' }}">
    <label for="purchased_at" class="col-md-2 control-label">{{ trans('assets.purchased_at') }}</label>
    <div class="col-md-10">
        <input class="form-control datetime-picker" name="purchased_at" type="text" id="purchased_at" value="{{ toDateTimeFormat(old('purchased_at', optional($asset)->purchased_at)) }}" required="true" placeholder="Enter purchased at here...">
        {!! $errors->first('purchased_at', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
    <label for="notes" class="col-md-2 control-label">{{ trans('assets.notes') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="notes" cols="50" rows="10" id="notes" maxlength="1000">{{ old('notes', optional($asset)->notes) }}</textarea>
        {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
    </div>
</div>
