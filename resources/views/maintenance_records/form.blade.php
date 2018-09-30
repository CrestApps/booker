@php
    $totalChecks = old('check_count_to_use', count(optional($maintenanceRecord)->payableChecks ?? []));
    $checksClass = $totalChecks == 0 ? 'hidden' : '';
    $checks = optional($maintenanceRecord)->payableChecks;

    if(is_null($checks) || count($checks) == 0){
        $checks = [
            ['id' => null,
             'number' => null,
             'value' => null,
             'due_date' => null,]
         ];
    }

@endphp

<div class="form-group {{ $errors->has('vehicle_id') ? 'has-error' : '' }}">
    <label for="vehicle_id" class="col-md-2 control-label">{{ trans('maintenance_records.vehicle_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="vehicle_id" name="vehicle_id" required="true">
                <option value="" style="display: none;" {{ old('vehicle_id', optional($maintenanceRecord)->vehicle_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a vehicle</option>
            @foreach ($vehicles as $key => $vehicle)
                <option value="{{ $key }}" {{ old('vehicle_id', optional($maintenanceRecord)->vehicle_id) == $key ? 'selected' : '' }}>
                    {{ $vehicle }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('vehicle_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
    <label for="category_id" class="col-md-2 control-label">{{ trans('maintenance_records.category_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="category_id" name="category_id" required="true">
                <option value="" style="display: none;" {{ old('category_id', optional($maintenanceRecord)->category_id ?: '') == '' ? 'selected' : '' }} disabled selected>Please select a category</option>
            @foreach ($catgeories as $key => $category)
                <option value="{{ $key }}" {{ old('category_id', optional($maintenanceRecord)->category_id) == $key ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
    <label for="payment_method" class="col-md-2 control-label">Payment Method</label>
    <div class="col-md-10">
        <select class="form-control" id="payment_method" name="payment_method" required="required">
                <option value="" style="display: none;" {{ old('payment_method', optional($maintenanceRecord)->payment_method ?: '') == '' ? 'selected' : '' }} disabled selected>Enter payment method here...</option>
            @foreach (['cash' => 'Cash',
                       'checks' => 'Checks'] as $key => $text)
                <option value="{{ $key }}" {{ old('payment_method', optional($maintenanceRecord)->payment_method) == $key ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('payment_method', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
    <label for="cost" class="col-md-2 control-label">{{ trans('maintenance_records.cost') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="cost" type="number" id="cost" value="{{ old('cost', optional($maintenanceRecord)->cost) }}" required="required" min="1" max="9999999" step="any">
        {!! $errors->first('cost', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="check-method {{ $checksClass }} form-group {{ $errors->has('check_count_to_use') ? 'has-error' : '' }}">
    <label for="check_count_to_use" class="col-md-2 control-label">How many checks used?</label>
    <div class="col-md-10">
        <select class="form-control" id="check_count_to_use" name="check_count_to_use">
            @foreach (range(1, 10) as $text)
                <option value="{{ $text }}" {{ $totalChecks == $text ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('check_count_to_use', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="check-method form-group {{ $checksClass }}">
    <label for="check_count_to_use" class="col-md-2 control-label"></label>
    <div class="col-md-10">
        <div style="width: 500px;">
            <div class="row">
                <div class="col-md-4">
                    Check number
                </div>

                <div class="col-md-4">
                    Check amount
                </div>

                <div class="col-md-4">
                    Due date
                </div>
            </div>
            <div id="checks_container">
                @foreach(old('checks', $checks) as $key => $check)

                <div class="row">
                    <div class="col-md-4 error-wrapper">
                        <input type="hidden" name="checks[{{ $key }}][id]" value="{{ $check['id'] }}" />
                        <input type="text" class="form-control" placeholder="Check number.." name="checks[{{ $key }}][number]" value="{{ old("checks.$key.number", $check['number']) }}" min="1" required />
                    </div>

                    <div class="col-md-4 error-wrapper">
                        <input type="value" class="form-control" placeholder="Check amount.." name="checks[{{ $key }}][value]" value="{{ old("checks.$key.value", $check['value']) }}" min="1" required />
                    </div>

                    <div class="col-md-4 error-wrapper">
                        <input type="text" class="form-control date-picker" placeholder="Due date" name="checks[{{ $key }}][due_date]" value="{{ old("checks.$key.due_date", $check['due_date'] && !is_string($check['due_date']) ? $check['due_date']->format(config('app.date_out_format')) : '') }}" required />
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('paid_at') ? 'has-error' : '' }}">
    <label for="paid_at" class="col-md-2 control-label">{{ trans('maintenance_records.paid_at') }}</label>
    <div class="col-md-10">
        <input class="form-control date-picker" name="paid_at" type="text" id="paid_at" value="{{ old('paid_at', optional(optional($maintenanceRecord)->paid_at)->format(config('app.date_out_format'))) }}" required="true">
        {!! $errors->first('paid_at', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('related_date') ? 'has-error' : '' }}">
    <label for="related_date" class="col-md-2 control-label">{{ trans('maintenance_records.related_date') }}</label>
    <div class="col-md-10">
        <input class="form-control date-picker" name="related_date" type="text" id="related_date" value="{{ old('related_date', optional(optional($maintenanceRecord)->related_date)->format(config('app.date_out_format'))) }}" required="true">
        {!! $errors->first('related_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
    <label for="notes" class="col-md-2 control-label">{{ trans('maintenance_records.notes') }}</label>
    <div class="col-md-10">
        <textarea class="form-control" name="notes" id="notes" maxlength="1000">{{ old('notes', optional($maintenanceRecord)->notes) }}</textarea>
        {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
    </div>
</div>
