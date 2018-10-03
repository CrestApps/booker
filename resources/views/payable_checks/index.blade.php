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
                <h4 class="mt-5 mb-5">{{ trans('payable_checks.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('payable_checks.payable_check.create') }}" class="btn btn-success" title="{{ trans('payable_checks.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        @if(count($payableChecks) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('payable_checks.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('payable_checks.number') }}</th>
                            <th>{{ trans('payable_checks.value') }}</th>
                            <th>{{ trans('payable_checks.due_date') }}</th>
                            <th>{{ trans('payable_checks.issue_date') }}</th>
                            <th>{{ trans('payable_checks.is_cashed') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($payableChecks as $payableCheck)
                        <tr>
                            <td>{{ $payableCheck->number }}</td>
                            <td>{{ $payableCheck->value }}</td>
                            <td>{{ toDateFormat($payableCheck->due_date) }}</td>
                            <td>{{ toDateFormat($payableCheck->issue_date) }}</td>
                            <td>{{ ($payableCheck->is_cashed) ? 'Yes' : 'No' }}</td>

                            <td>

                                <form method="POST" action="{!! route('payable_checks.payable_check.destroy', $payableCheck->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('payable_checks.payable_check.show', $payableCheck->id ) }}" class="btn btn-info" title="{{ trans('payable_checks.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('payable_checks.payable_check.edit', $payableCheck->id ) }}" class="btn btn-primary" title="{{ trans('payable_checks.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('payable_checks.delete') }}" onclick="return confirm(&quot;{{ trans('payable_checks.confirm_delete') }}&quot;)">
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
            {!! $payableChecks->render() !!}
        </div>

        @endif

    </div>
@endsection
