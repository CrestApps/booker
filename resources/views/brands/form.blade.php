
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('brands.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($brand)->name) }}" minlength="1" maxlength="255" required="true">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
    <label for="notes" class="col-md-2 control-label">{{ trans('brands.notes') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="notes" cols="50" rows="10" id="notes" maxlength="1000">{{ old('notes', optional($brand)->notes) }}</textarea>
        {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
    </div>
</div>

