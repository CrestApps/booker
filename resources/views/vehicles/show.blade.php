@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($vehicle->name) ? $vehicle->name : 'Vehicle' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('vehicles.vehicle.destroy', $vehicle->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('vehicles.vehicle.index') }}" class="btn btn-primary" title="{{ trans('vehicles.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('vehicles.vehicle.create') }}" class="btn btn-success" title="{{ trans('vehicles.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('vehicles.vehicle.edit', $vehicle->id ) }}" class="btn btn-primary" title="{{ trans('vehicles.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('vehicles.delete') }}" onclick="return confirm(&quot;{{ trans('vehicles.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('vehicles.name') }}</dt>
            <dd>{{ $vehicle->name }}</dd>
            <dt>{{ trans('vehicles.size_id') }}</dt>
            <dd>{{ optional($vehicle->size)->name }}</dd>
            <dt>{{ trans('vehicles.brand_id') }}</dt>
            <dd>{{ optional($vehicle->brand)->name }}</dd>
            <dt>{{ trans('vehicles.model') }}</dt>
            <dd>{{ $vehicle->model }}</dd>
            <dt>{{ trans('vehicles.year') }}</dt>
            <dd>{{ $vehicle->year }}</dd>
            <dt>{{ trans('vehicles.color') }}</dt>
            <dd>{{ $vehicle->color }}</dd>
            <dt>{{ trans('vehicles.last_oil_change') }}</dt>
            <dd>{{ $vehicle->last_oil_change }}</dd>
            <dt>{{ trans('vehicles.miles_to_oil_change') }}</dt>
            <dd>{{ $vehicle->miles_to_oil_change }}</dd>
            <dt>{{ trans('vehicles.current_miles') }}</dt>
            <dd>{{ $vehicle->current_miles }}</dd>
            <dt>{{ trans('vehicles.registration_experation_on') }}</dt>
            <dd>{{ $vehicle->registration_experation_on }}</dd>
            <dt>{{ trans('vehicles.insurance_experation_on') }}</dt>
            <dd>{{ $vehicle->insurance_experation_on }}</dd>
            <dt>{{ trans('vehicles.daily_rate') }}</dt>
            <dd>{{ $vehicle->daily_rate }}</dd>
            <dt>{{ trans('vehicles.weekly_rate') }}</dt>
            <dd>{{ $vehicle->weekly_rate }}</dd>
            <dt>{{ trans('vehicles.monthly_rate') }}</dt>
            <dd>{{ $vehicle->monthly_rate }}</dd>
            <dt>{{ trans('vehicles.is_active') }}</dt>
            <dd>{{ ($vehicle->is_active) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('vehicles.vin_number') }}</dt>
            <dd>{{ $vehicle->vin_number }}</dd>
            <dt>{{ trans('vehicles.licence_plate') }}</dt>
            <dd>{{ $vehicle->licence_plate }}</dd>
            <dt>{{ trans('vehicles.purchase_cost') }}</dt>
            <dd>{{ $vehicle->purchase_cost }}</dd>
            <dt>Purchased Date</dt>
            <dd>{{ $vehicle->purchased_date }}</dd>
            <dt>Sold Date</dt>
            <dd>{{ $vehicle->sold_date }}</dd>
            <dt>Sold Amount</dt>
            <dd>{{ $vehicle->sold_amount }}</dd>

        </dl>

    </div>
</div>

@endsection