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

            <form method="POST" action="{{ route('reports.report.show_vehicle_usage') }}" accept-charset="UTF-8" class="form-inline">
	            {{ csrf_field() }}
	            @include ('reports._range')

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{{ trans('reports.run') }}">
                </div>

            </form>

        </div>

        @if(!isset($records))
        <div class="panel-body">
            <div class="panel-body text-center">
                <h4>{{ trans('reports.use_the_filters_above_to_start') }}</h4>
            </div>
        </div>
        @elseif(count($records) == 0)
        <div class="panel-body">
            <div class="panel-body text-center">
                <h4>{{ trans('reports.no_available_records') }}</h4>
            </div>
        </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('vehicles.name') }}</th>
                            <th class="text-center">{{ trans('reports.average_price') }}</th>
                            <th class="text-center">{{ trans('reports.total_days_in_service') }}</th>
                            <th class="text-center">{{ trans('reports.usage_percentage') }}</th>
                            <th class="text-center">{{ trans('reports.total_days_rented') }}</th>
                            <th class="text-center">{{ trans('reports.total_income') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($records) && $records)
	                    @foreach($records as $record)
	                        <tr>
	                            <td>{{ $record->name }}</td>
	                            <td class="text-center">{{ number_format($record->average_price, 2) }}</td>
                                <td class="text-center">{{ number_format($record->total_days_in_service, 0)  }}</td>
                                <td class="text-center">{{ number_format(($record->total_days_rented/$record->total_days_in_service) * 100, 2)  }} %</td>
                                <td class="text-center">{{ number_format($record->total_days_rented, 0) }}</td>
                                <td class="text-center">{{ number_format($record->total_income, 2) }}</td>
	                        </tr>
	                    @endforeach
                    @endif
                    </tbody>

                </table>

            </div>
        </div>

        @endif

    </div>
@endsection
