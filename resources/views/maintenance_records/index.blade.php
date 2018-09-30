@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('maintenance_records.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('maintenance_records.maintenance_record.create') }}" class="btn btn-success" title="{{ trans('maintenance_records.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        @if(count($maintenanceRecords) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('maintenance_records.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('maintenance_records.vehicle_id') }}</th>
                            <th>{{ trans('maintenance_records.category_id') }}</th>
                            <th>Payment Method</th>
                            <th>{{ trans('maintenance_records.cost') }}</th>
                            <th>{{ trans('maintenance_records.paid_at') }}</th>
                            <th>{{ trans('maintenance_records.related_date') }}</th>
                            <th>{{ trans('maintenance_records.notes') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($maintenanceRecords as $maintenanceRecord)
                        <tr>
                            <td>{{ optional($maintenanceRecord->vehicle)->name }}</td>
                            <td>{{ optional($maintenanceRecord->category)->name }}</td>
                            <td>{{ $maintenanceRecord->payment_method }}</td>
                            <td>{{ $maintenanceRecord->cost }}</td>
                            <td>{{ $maintenanceRecord->paid_at->format(config('app.date_out_format')) }}</td>
                            <td>{{ $maintenanceRecord->related_date->format(config('app.date_out_format')) }}</td>
                            <td>{{ $maintenanceRecord->notes }}</td>

                            <td>

                                <form method="POST" action="{!! route('maintenance_records.maintenance_record.destroy', $maintenanceRecord->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('maintenance_records.maintenance_record.show', $maintenanceRecord->id ) }}" class="btn btn-info" title="{{ trans('maintenance_records.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('maintenance_records.maintenance_record.edit', $maintenanceRecord->id ) }}" class="btn btn-primary" title="{{ trans('maintenance_records.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('maintenance_records.delete') }}" onclick="return confirm(&quot;{{ trans('maintenance_records.confirm_delete') }}&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $maintenanceRecords->render() !!}
        </div>

        @endif

    </div>
@endsection
