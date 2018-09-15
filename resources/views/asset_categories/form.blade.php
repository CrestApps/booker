
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('asset_categories.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($assetCategory)->name) }}" minlength="1" maxlength="255" required="true">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
    <label for="is_active" class="col-md-2 control-label">{{ trans('asset_categories.is_active') }}</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="is_active_1">
            	<input id="is_active_1" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($assetCategory)->is_active ?: '1') == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
    <label for="notes" class="col-md-2 control-label">{{ trans('asset_categories.notes') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="notes" cols="50" rows="10" id="notes" maxlength="1000">{{ old('notes', optional($assetCategory)->notes) }}</textarea>
        {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
    </div>
</div>

