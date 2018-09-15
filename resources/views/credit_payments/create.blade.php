@extends('layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('credit_payments.create') }}</h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('credit_payments.credit_payment.index') }}" class="btn btn-primary" title="{{ trans('credit_payments.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('credit_payments.credit_payment.store') }}" accept-charset="UTF-8" id="create_credit_payment_form" name="create_credit_payment_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('credit_payments.form', [
                                        'creditPayment' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('credit_payments.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


