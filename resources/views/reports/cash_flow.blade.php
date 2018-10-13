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

            <form method="POST" action="{{ route('reports.report.show_cash_flow') }}" accept-charset="UTF-8" class="form-inline">
	            {{ csrf_field() }}
	            @include ('reports._range')

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{{ trans('reports.run') }}">
                </div>

            </form>

        </div>

        @if(!isset($totalCash))
        <div class="panel-body">
            <div class="panel-body text-center">
                <h4>{{ trans('reports.use_the_filters_above_to_start') }}</h4>
            </div>
        </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">

                    <thead>
                        <tr>
                            <th>{{ trans('reports.expense_category_name') }}</th>
                            <th class="text-center">{{ trans('reports.operation_cost') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{ trans('reports.cash_received') }}</td>
                            <td class="text-center">{{ number_format($totalCash + $totalCards, 2) }}</td>
                        </tr>

                        <tr>
                            <td>{{ trans('reports.total_credits') }}</td>
                            <td class="text-center">{{ number_format($totalCredits, 2) }}</td>
                        </tr>

                        <tr>
                            <td>{{ trans('reports.cost_of_service_rendered') }}</td>
                            <td class="text-center">{{ number_format($totalMaintenances, 2) }}</td>
                        </tr>

                        <tr>
                            <td>{{ trans('reports.operating_expense') }}</td>
                            <td class="text-center">{{ number_format($totalExpenses, 2) }}</td>
                        </tr>
                        <tr>
                            <td><strong>{{ trans('reports.net_operating_income') }}</strong></td>
                            <td class="text-center">
                                <strong>{{ number_format($totalCash + $totalCards + $totalCredits - $totalMaintenances - $totalExpenses, 2) }}</strong>
                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>
        </div>

        @endif

    </div>
@endsection
