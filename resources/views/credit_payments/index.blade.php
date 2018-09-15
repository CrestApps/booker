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
                <h4 class="mt-5 mb-5">{{ trans('credit_payments.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('credit_payments.credit_payment.create') }}" class="btn btn-success" title="{{ trans('credit_payments.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($creditPayments) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('credit_payments.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('credit_payments.credit_id') }}</th>
                            <th>{{ trans('credit_payments.amount') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($creditPayments as $creditPayment)
                        <tr>
                            <td>{{ optional($creditPayment->credit)->id }}</td>
                            <td>{{ $creditPayment->amount }}</td>

                            <td>

                                <form method="POST" action="{!! route('credit_payments.credit_payment.destroy', $creditPayment->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('credit_payments.credit_payment.show', $creditPayment->id ) }}" class="btn btn-info" title="{{ trans('credit_payments.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('credit_payments.credit_payment.edit', $creditPayment->id ) }}" class="btn btn-primary" title="{{ trans('credit_payments.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('credit_payments.delete') }}" onclick="return confirm(&quot;{{ trans('credit_payments.confirm_delete') }}&quot;)">
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
            {!! $creditPayments->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection