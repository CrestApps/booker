<div class="form-group">
	<label class="sr-only" for="from">{{ trans('reports.from') }}</label>
	<input type="text" name="from" id="from" class="form-control date-from" value="{{ isset($from) ? $from : '' }}" placeholder="{{ trans('reports.from') }}">
</div>

<div class="form-group">
	<label class="sr-only" for="to">{{ trans('reports.to') }}</label>
	<input type="text" name="to" id="to" class="form-control date-to" value="{{ isset($to) ? $to : '' }}" placeholder="{{ trans('reports.to') }}">
</div>
