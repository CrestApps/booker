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
<div id="credits_show"></div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Credit' }}</h4>
        </span>

        <div class="pull-right">

                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('credits.credit.index') }}" class="btn btn-primary" title="{{ trans('credits.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                </div>
        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('credits.customer_id') }}</dt>
            <dd>{{ optional($credit->customer)->fullname }}</dd>
            <dt>{{ trans('credits.amount') }}</dt>
            <dd>{{ $credit->amount }}</dd>

        </dl>

    </div>
</div>


<div class="panel panel-warning">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ trans('credit_payments.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <div class="btn-group btn-group-sm" role="group">
                @if($credit->amount > 0)
                <a href="{{ route('credits.credit.create') }}" class="btn btn-success" title="{{ trans('credits.create') }}" id="create_payment">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
                @endif
            </div>

        </div>

    </div>

    <div class="panel-body">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ trans('credit_payments.amount') }}</th>
                    <th>{{ trans('reservations.payment_methods') }}</th>
                    <th>{{ trans('credit_payments.paid_at') }}</th>
                    <th></th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($credit->payments as $payment)
                <tr>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ trans("reservations.$payment->payment_method") }}</td>
                    <td>{{ toDateTimeFormat($payment->created_at) }}</td>
                    <td>
                        @if($payment->check_id)
                            <a href="{!! route('checks.check.show', $payment->check_id) !!}">{{ trans('checks.show') }}</a>
                        @endif
                    </td>

                    <td>

                        <form method="POST" action="{!! route('credit_payments.credit_payment.destroy', $payment->id) !!}" accept-charset="UTF-8">
                        <input name="_method" value="DELETE" type="hidden">
                        <input id="payment_id" name="payment_id" value="" type="hidden" value="">
                        {{ csrf_field() }}

                            <div class="btn-group btn-group-xs pull-right" role="group">

                                <a href="#" class="btn btn-primary edit-payment" title="{{ trans('credit_payments.edit') }}" data-amount="{{ $payment->amount }}" data-payment-method="{{ $payment->payment_method }}" data-payment-id="{{ $payment->id }}">
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

            <tfoot>
                <tr>
                    <td><strong>{{ $credit->payments->sum('amount') }}</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>




<div class="panel panel-info">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ trans('reservations.reservations_history') }}</h4>
        </span>

        <div class="pull-right">

            <div class="btn-group btn-group-sm" role="group">
            </div>

        </div>

    </div>

    <div class="panel-body">

        <div class="table-responsive">

            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('reservations.model_singular') }}</th>
                            <th>{{ trans('reservations.reserved_from') }}</th>
                            <th>{{ trans('reservations.reserved_to') }}</th>
                            <th>{{ trans('reservations.total_rent') }}</th>
                            <th>{{ trans('reservations.due_date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($credit->reservationRelations as $reservationToCredit)
                        <tr>
                            <td>
                                <a href="{!! route('reservations.reservation.show', $reservationToCredit->reservation_id) !!}">
                                {{ trans('reservations.show') }}</a>
                            </td>
                            <td>{{ toDateFormat(optional($reservationToCredit->reservation)->reserved_from) }}</td>
                            <td>{{ toDateFormat(optional($reservationToCredit->reservation)->reserved_to) }}</td>
                            <td>{{ $reservationToCredit->amount }}</td>
                            <td>{{ toDateFormat($reservationToCredit->due_date) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>{{ $credit->reservationRelations->sum('amount') }}</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>

    </div>
</div>



<!-- Create Payment Modal -->
<div id="payment_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="payment_model_title" class="modal-title" data-edit-title="{{ trans('credits.edit_payment') }}" data-add-title="{{ trans('credits.make_payment') }}"></h4>
      </div>
      <div class="modal-body">
            <div class="alert hidden" id="payment_model_alert"></div>
            <form accept-charset="UTF-8" id="create_credit_payment_form" name="create_credit_payment_form" class="form-horizontal">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $credit->id }}" name="credit_id">
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <label for="amount" class="col-md-3 control-label">{{ trans('credit_payments.amount') }}</label>
                    <div class="col-md-9">
                        <input class="form-control" name="amount" type="number" id="amount" value="" min="0.01" max="9999999" required="true" step="any">
                        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                    <label for="payment_method" class="col-md-3 control-label">Payment Method</label>
                    <div class="col-md-9">
                        <select class="form-control" name="payment_method" id="payment_method" required>
                            <option value="" style="display: none;" selected="" disabled="">{{ trans('reservations.select_payment_method') }}</option>
                            <option value="cash">{{ trans('reservations.cash') }}</option>
                            <option value="bank_card">{{ trans('reservations.bank_card') }}</option>
                            <option value="check">{{ trans('reservations.check') }}</option>
                        </select>

                        {!! $errors->first('payment_method', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group due_date_block hidden {{ $errors->has('due_date') ? 'has-error' : '' }}">
                    <label for="due_date" class="col-md-3 control-label">Check</label>
                    <div class="col-md-9">
                        <input id="due_date" class="form-control date-picker" name="due_date" type="text" placeholder="{{ trans('reservations.due_date') }}" required />

                        {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <input class="btn btn-primary" type="button" value="{{ trans('credits.save') }}" id="create_credit_payment_form_submit">
                    </div>
                </div>

            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection
