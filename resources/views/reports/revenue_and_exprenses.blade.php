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

            <form method="POST" action="{{ route('reports.report.show_revenue_and_exprenses') }}" accept-charset="UTF-8" class="form-inline">
	            {{ csrf_field() }}
	            @include ('reports._range')

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{{ trans('reports.run') }}">
                </div>

            </form>

        </div>

        @if(!isset($vehicles) || !isset($expenseRecords))
        <div class="panel-body">
            <div class="panel-body text-center">
                <h4>{{ trans('reports.use_the_filters_above_to_start') }}</h4>
            </div>
        </div>
        @elseif(count($vehicles) == 0 && count($expenseRecords) == 0)
        <div class="panel-body">
            <div class="panel-body text-center">
                <h4>{{ trans('reports.no_available_records') }}</h4>
            </div>
        </div>
        @else
        @php
            $totalCost = $vehicles->sum('cost');
            $totalIncome = $vehicles->sum('total_income');
            $totalOperationCost = $expenseRecords->sum('cost');
        @endphp
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">


                    <thead>
                        <tr>
                            <th>{{ trans('reports.vehicle_name') }}</th>
                            <th class="text-center">{{ trans('reports.cost_of_service_rendered') }}</th>
                            <th class="text-center">{{ trans('reports.total_income') }}</th>
                            <th class="text-center">{{ trans('reports.net_revenue') }}</th>
                        </tr>
                    </thead>
                    <tbody>
	                    @foreach($vehicles as $vehicle)
	                        <tr>
	                            <td>{{ $vehicle->name }}</td>
	                            <td class="text-center">{{ number_format($vehicle->cost, 2) }}</td>
                                <td class="text-center">{{ number_format($vehicle->total_income, 2)  }}</td>
                                <td class="text-center">{{ number_format(($vehicle->total_income - $vehicle->cost), 2)  }}</td>
	                        </tr>
	                    @endforeach
                        <tr>
                            <td><strong>{{ trans('reports.subtotal') }}</strong></td>
                            <td class="text-center"><strong>{{ number_format($totalCost, 2) }}</strong></td>
                            <td class="text-center"><strong>{{ number_format($totalIncome, 2) }}</strong></td>
                            <td class="text-center"><strong>{{ number_format(($totalIncome - $totalCost), 2) }}</strong></td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>



                    <thead>
                        <tr>
                            <th>{{ trans('reports.expense_category_name') }}</th>
                            <th class="text-center">{{ trans('reports.operation_cost') }}</th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenseRecords as $expenseRecord)
                            <tr>
                                <td>{{ $expenseRecord->name }}</td>
                                <td class="text-center">{{ number_format($expenseRecord->cost, 2) }}</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><strong>{{ trans('reports.subtotal') }}</strong></td>
                            <td class="text-center"><strong>{{ number_format($totalOperationCost, 2) }}</strong></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>{{ trans('reports.grand_total') }}</strong></td>
                            <td class="text-center"><strong>{{ number_format($totalOperationCost + $totalCost, 2) }}</strong></td>
                            <td class="text-center"><strong>{{ number_format($totalIncome, 2) }}</strong></td>
                            <td class="text-center"><strong>{{ number_format(($totalIncome - $totalOperationCost + $totalCost), 2) }}</strong></td>
                        </tr>
                    </tfoot>

                </table>

            </div>
        </div>

        @endif

    </div>
@endsection
