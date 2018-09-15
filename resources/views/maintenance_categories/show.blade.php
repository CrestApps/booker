@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($maintenanceCategory->name) ? $maintenanceCategory->name : 'Maintenance Category' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('maintenance_categories.maintenance_category.destroy', $maintenanceCategory->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('maintenance_categories.maintenance_category.index') }}" class="btn btn-primary" title="{{ trans('maintenance_categories.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('maintenance_categories.maintenance_category.create') }}" class="btn btn-success" title="{{ trans('maintenance_categories.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('maintenance_categories.maintenance_category.edit', $maintenanceCategory->id ) }}" class="btn btn-primary" title="{{ trans('maintenance_categories.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('maintenance_categories.delete') }}" onclick="return confirm(&quot;{{ trans('maintenance_categories.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('maintenance_categories.name') }}</dt>
            <dd>{{ $maintenanceCategory->name }}</dd>
            <dt>{{ trans('maintenance_categories.is_active') }}</dt>
            <dd>{{ ($maintenanceCategory->is_active) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('maintenance_categories.notes') }}</dt>
            <dd>{{ $maintenanceCategory->notes }}</dd>

        </dl>

    </div>
</div>

@endsection