
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('expense_categories.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($expenseCategory)->name) }}" minlength="1" maxlength="255" required="true">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('sort') ? 'has-error' : '' }}">
    <label for="sort" class="col-md-2 control-label">{{ trans('expense_categories.sort') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="sort" type="number" id="sort" value="{{ old('sort', optional($expenseCategory)->sort) }}" min="-2147483648" max="2147483647">
        {!! $errors->first('sort', '<p class="help-block">:message</p>') !!}
    </div>
</div>

