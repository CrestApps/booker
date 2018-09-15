@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Maintenance Record' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('maintenance_records.maintenance_record.destroy', $maintenanceRecord->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('maintenance_records.maintenance_record.index') }}" class="btn btn-primary" title="{{ trans('maintenance_records.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('maintenance_records.maintenance_record.create') }}" class="btn btn-success" title="{{ trans('maintenance_records.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('maintenance_records.maintenance_record.edit', $maintenanceRecord->id ) }}" class="btn btn-primary" title="{{ trans('maintenance_records.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('maintenance_records.delete') }}" onclick="return confirm(&quot;{{ trans('maintenance_records.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('maintenance_records.vehicle_id') }}</dt>
            <dd>{{ optional($maintenanceRecord->vehicle)->name }}</dd>
            <dt>{{ trans('maintenance_records.catgeory_id') }}</dt>
            <dd>{{ optional($maintenanceRecord->catgeory)->name }}</dd>
            <dt>{{ trans('maintenance_records.cost') }}</dt>
            <dd>{{ $maintenanceRecord->cost }}</dd>
            <dt>{{ trans('maintenance_records.paid_at') }}</dt>
            <dd>{{ $maintenanceRecord->paid_at }}</dd>
            <dt>{{ trans('maintenance_records.related_date') }}</dt>
            <dd>{{ $maintenanceRecord->related_date }}</dd>
            <dt>{{ trans('maintenance_records.notes') }}</dt>
            <dd>{{ $maintenanceRecord->notes }}</dd>

        </dl>

    </div>
</div>

@endsection