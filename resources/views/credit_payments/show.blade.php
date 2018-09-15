@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Credit Payment' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('credit_payments.credit_payment.destroy', $creditPayment->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('credit_payments.credit_payment.index') }}" class="btn btn-primary" title="{{ trans('credit_payments.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('credit_payments.credit_payment.create') }}" class="btn btn-success" title="{{ trans('credit_payments.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('credit_payments.credit_payment.edit', $creditPayment->id ) }}" class="btn btn-primary" title="{{ trans('credit_payments.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('credit_payments.delete') }}" onclick="return confirm(&quot;{{ trans('credit_payments.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('credit_payments.credit_id') }}</dt>
            <dd>{{ optional($creditPayment->credit)->id }}</dd>
            <dt>{{ trans('credit_payments.amount') }}</dt>
            <dd>{{ $creditPayment->amount }}</dd>

        </dl>

    </div>
</div>

@endsection