@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($vehicleSize->name) ? $vehicleSize->name : 'Vehicle Size' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('vehicle_sizes.vehicle_size.destroy', $vehicleSize->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('vehicle_sizes.vehicle_size.index') }}" class="btn btn-primary" title="{{ trans('vehicle_sizes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('vehicle_sizes.vehicle_size.create') }}" class="btn btn-success" title="{{ trans('vehicle_sizes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('vehicle_sizes.vehicle_size.edit', $vehicleSize->id ) }}" class="btn btn-primary" title="{{ trans('vehicle_sizes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('vehicle_sizes.delete') }}" onclick="return confirm(&quot;{{ trans('vehicle_sizes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('vehicle_sizes.name') }}</dt>
            <dd>{{ $vehicleSize->name }}</dd>

        </dl>

    </div>
</div>

@endsection