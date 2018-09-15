
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">{{ trans('expense_categories.title') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($expenseCategory)->title) }}" minlength="1" maxlength="255" required="true">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('sort') ? 'has-error' : '' }}">
    <label for="sort" class="col-md-2 control-label">{{ trans('expense_categories.sort') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="sort" type="number" id="sort" value="{{ old('sort', optional($expenseCategory)->sort) }}" min="-2147483648" max="2147483647">
        {!! $errors->first('sort', '<p class="help-block">:message</p>') !!}
    </div>
</div>

