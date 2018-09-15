@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Reservation' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('reservations.reservation.destroy', $reservation->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('reservations.reservation.index') }}" class="btn btn-primary" title="{{ trans('reservations.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('reservations.reservation.create') }}" class="btn btn-success" title="{{ trans('reservations.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('reservations.reservation.edit', $reservation->id ) }}" class="btn btn-primary" title="{{ trans('reservations.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('reservations.delete') }}" onclick="return confirm(&quot;{{ trans('reservations.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('reservations.primary_driver_id') }}</dt>
            <dd>{{ optional($reservation->primaryDriver)->fullname }}</dd>
            <dt>{{ trans('reservations.vehicle_id') }}</dt>
            <dd>{{ optional($reservation->vehicle)->name }}</dd>
            <dt>{{ trans('reservations.reserved_from') }}</dt>
            <dd>{{ $reservation->reserved_from }}</dd>
            <dt>{{ trans('reservations.reserved_to') }}</dt>
            <dd>{{ $reservation->reserved_to }}</dd>
            <dt>{{ trans('reservations.total_override') }}</dt>
            <dd>{{ $reservation->total_override }}</dd>
            <dt>{{ trans('reservations.total_rent') }}</dt>
            <dd>{{ $reservation->total_rent }}</dd>
            <dt>{{ trans('reservations.total_tax') }}</dt>
            <dd>{{ $reservation->total_tax }}</dd>
            <dt>{{ trans('reservations.total_paid_in_cash') }}</dt>
            <dd>{{ $reservation->total_paid_in_cash }}</dd>
            <dt>{{ trans('reservations.total_paid_in_bank_card') }}</dt>
            <dd>{{ $reservation->total_paid_in_bank_card }}</dd>
            <dt>{{ trans('reservations.mileage_started_at') }}</dt>
            <dd>{{ $reservation->mileage_started_at }}</dd>
            <dt>{{ trans('reservations.mileage_ends_at') }}</dt>
            <dd>{{ $reservation->mileage_ends_at }}</dd>
            <dt>{{ trans('reservations.status') }}</dt>
            <dd>{{ $reservation->status }}</dd>

        </dl>

    </div>
</div>

@endsection