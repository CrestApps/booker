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

            <form method="POST" action="{{ route('reports.report.show_maintenance') }}" accept-charset="UTF-8" class="form-inline">
	            {{ csrf_field() }}
	            @include ('reports._range')
                <div class="form-group">
                    <label class="sr-only" for="vehicle_id">{{ trans('reports.vehicles') }}</label>
                    <select class="form-control" id="vehicle_id" name="vehicle_id">
                        <option value="" {{ old('vehicle_id', isset($vehicleId) ? $vehicleId : '' ) == '' ? 'selected' : '' }}>{{ trans('reports.all_vehicles') }}</option>
                        @foreach ($vehicles as $key => $vehicle)
                            <option value="{{ $key }}" {{ old('vehicle_id', isset($vehicleId) ? $vehicleId : '') == $key ? 'selected' : '' }}>
                                {{ $vehicle }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{{ trans('reports.run') }}">
                </div>

            </form>

        </div>

        @if(!isset($maintenanceRecords) && !isset($expenseRecords))
        <div class="panel-body">
            <div class="panel-body text-center">
                <h4>{{ trans('reports.use_the_filters_above_to_start') }}</h4>
            </div>
        </div>
        @elseif(count($maintenanceRecords) == 0 && count($expenseRecords) == 0)
        <div class="panel-body">
            <div class="panel-body text-center">
                <h4>{{ trans('reports.no_available_records') }}</h4>
            </div>
        </div>
        @else

            @if(isset($expenseRecords))
            <div class="panel-body panel-body-with-table">
                <div class="table-responsive">

                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>{{ trans('reports.category_name') }}</th>
                                <th class="text-center">{{ trans('reports.cost') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expenseRecords as $record)
                                <tr>
                                    <td>{{ $record->name }}</td>
                                    <td class="text-center">{{ number_format($record->cost, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
            @endif

            @if(isset($maintenanceRecords))
            <div class="panel-body panel-body-with-table">
                <div class="table-responsive">

                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>{{ trans('reports.vehicle_name') }}</th>
                                <th class="text-center">{{ trans('reports.pay_date') }}</th>
                                <th class="text-center">{{ trans('reports.related_month') }}</th>
                                <th>{{ trans('reports.expense_category_name') }}</th>
                                <th class="text-center">{{ trans('reports.cost') }}</th>
                                <th>{{ trans('reports.notes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
    	                    @foreach($maintenanceRecords as $record)
    	                        <tr>
    	                            <td>{{ optional($record->vehicle)->name }}</td>
                                    <td class="text-center">{{ toDateFormat($record->paid_at) }}</td>
    	                            <td class="text-center">{{ toMonthFormat($record->related_date) }}</td>
                                    <td>{{ optional($record->category)->name }}</td>
                                    <td class="text-center">{{ number_format($record->cost, 2) }}</td>
                                    <td>{{ $record->notes }}</td>
    	                        </tr>
    	                    @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td></td>
                                <td class="text-center">{{ number_format($maintenanceRecords->sum('cost'), 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>
            @endif

        @endif

    </div>
@endsection
