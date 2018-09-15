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

        @if(Session::has('error_message'))
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            {!! session('error_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Reservation' }}</h4>
        </span>

        <div class="pull-right">

            <div class="btn-group btn-group-sm" role="group">
                <a href="{{ route('reservation_dropoffs.reservation_dropoff.index') }}" class="btn btn-primary" title="{{ trans('reservations.show_all_scheduled_reservations') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('reservations.reservation.create') }}" class="btn btn-success" title="{{ trans('reservations.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>

                <a href="{{ route('reservations.reservation.edit', $reservation->id ) }}" class="btn btn-primary" title="{{ trans('reservations.edit') }}">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
            </div>

        </div>

    </div>

    <div class="panel-body">
        <!-- The reservation over view -->
        <dl class="dl-horizontal">
            <dt>{{ trans('reservations.primary_driver_id') }}</dt>
            <dd>{{ optional($reservation->primaryDriver)->fullname }}</dd>

            <dt>{{ trans('reservations.additional_drivers') }}</dt>
            <dd>
                @foreach($reservation->additionalDrivers as $driver)
                <p class="mb-2">{{ $driver->fullname }}</p>
                @endforeach
            </dd>


            <dt>{{ trans('reservations.vehicle_id') }}</dt>
            <dd>{{ optional($reservation->vehicle)->name }}</dd>
            <dt>{{ trans('reservations.reserved_from') }}</dt>
            <dd>{{ $reservation->reserved_from->format(config('app.date_out_format')) }}</dd>
            <dt>{{ trans('reservations.reserved_to') }}</dt>
            <dd>{{ $reservation->reserved_to->format(config('app.date_out_format')) }}</dd>

            <dt>{{ trans('reservations.total_rent') }}</dt>
            <dd>{{ $reservation->total_rent }}</dd>
            <dt>{{ trans('reservations.total_tax') }}</dt>
            <dd>{{ $reservation->total_tax }}</dd>
        </dl>

        @if($totalDaysUsed != 0)
        <div class="alert alert-warning text-center">
            {{
              trans('reservations.droppoff_is_not_on_time_warning', [
                        'days' => $totalDaysUsed,
                        'early_late' => ($totalDaysUsed < 0) ? trans('reservations.early') : trans('reservations.late'),
                    ])
            }}
            <a href="{{ route('reservations.reservation.edit', $reservation->id) }}">{{ trans('reservations.click_here_to_edit_reservation') }}</a>
        </div>
       @endif

        <!-- The pickup form -->
        <fieldset>
            <legend>{{ trans('reservations.pickup') }}</legend>
            <form method="POST" action="{{ route('reservation_dropoffs.reservation_dropoff.process', $reservation->id) }}" accept-charset="UTF-8" id="pickup_reservation_form" name="pickup_reservation_form" class="form-horizontal">
                {{ csrf_field() }}

                <!-- Field to capture current miles -->
                <div class="form-group {{ $errors->has('current_miles') ? 'has-error' : '' }}">
                    <label for="current_miles" class="col-md-2 control-label">{{ trans('vehicles.current_miles') }}</label>
                    <div class="col-md-10">
                        <input class="form-control" name="current_miles" type="number" id="current_miles" value="{{ old('current_miles', $reservation->vehicle->current_miles) }}" min="100" required>
                        {!! $errors->first('current_miles', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <!-- Capture the payment(s) -->
                @if($totalOpenCredit > 0)
                <div class="form-group {{ $errors->has('payments') ? 'has-error' : '' }}">
                    <div class="col-md-2 control-label"></div>
                    <div class="col-md-10">
                        <div class="well well-sm width-600">
                            <p class="text-center">
                                {{
                                    trans('reservations.there_is_an_outstanding_balance_due', [
                                        'balance' => $totalOpenCredit
                                    ])
                                }}
                            </p>
                            <div class="panel panel-default">

                                <!-- Panel header -->
                                <div class="panel-heading clearfix">

                                    <!-- The title for the payment methods -->
                                    <div class="pull-left">
                                        {{ trans('reservations.payment') }}
                                    </div>

                                    <!-- Button to add new payment method on the screen  -->
                                    <div class="pull-right">

                                        <div class="btn-group btn-group-sm pull-right" role="group">

                                            <button id="add_payment_method" class="btn btn-success" title="{{ trans('reservations.pickup') }}">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ trans('reservations.add_payment_method') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Panel body -->
                                <div class="panel-body">

                                    <!-- The payment-methods section -->
                                    <div class="payment-methods-container">

                                        <!-- The default payment method -->
                                        <div class="row mt-5 mb-5">

                                            <!-- The type of the payment method -->
                                            <div class="col-md-4 pl-10 pr-5">
                                                <select class="form-control payment-method" name="payments[0][method]" required>
                                                    <option value="" style="display: none;" selected="" disabled="">{{ trans('reservations.select_payment_method') }}</option>

                                                    <option value="cash">{{ trans('reservations.cash') }}</option>
                                                    <option value="bank_card">{{ trans('reservations.bank_card') }}</option>
                                                    <option value="check">{{ trans('reservations.check') }}</option>
                                                </select>
                                            </div>

                                            <!-- The amout of the payment -->
                                            <div class="col-md-3 pl-0 pr-5">
                                                <input class="form-control payment-amount" name="payments[0][amount]" type="number" step="any" min="0" value="0" required />
                                            </div>

                                            <!-- The due-date for the check/credit -->
                                            <div class="col-md-3 pl-0 pr-5">
                                                <input class="form-control date-picker payment-method-due-date hidden" name="payments[0][due_date]" type="text" placeholder="{{ trans('reservations.due_date') }}" />

                                            </div>

                                            <!-- The button to remove the payment method -->
                                            <div class="col-md-2 pl-0 pr-5">
                                                <button class="btn btn-sm btn-danger hidden remove-button">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            </button>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- The remaining balance section-->
                                    <div class="row">

                                        <!-- The label for the remaining balance -->
                                        <div class="col-md-4 pl-10 pr-5">
                                            <p class="control-label">
                                                <strong>Total Due</strong>
                                            </p>
                                        </div>

                                        <!-- Remaining ballance -->
                                        <div class="col-md-3 pl-0 pr-5">
                                            <input class="form-control" id="remaining_balance" type="text" value="{{ $totalOpenCredit }}" data-due="{{ $totalOpenCredit }}" max="0" disabled/>
                                        </div>

                                        <!-- Gab filler -->
                                        <div class="col-md-5">
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('reservations.process_dropoff') }}">
                    </div>
                </div>

            </form>
        </fieldset>
    </div>
</div>

@endsection
