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
                <h4 class="mt-5 mb-5">{{ trans('reservations.pickup') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

            </div>

        </div>

        @if(count($reservations) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('reservations.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('reservations.primary_driver_id') }}</th>
                            <th>{{ trans('reservations.vehicle_id') }}</th>
                            <th>{{ trans('reservations.reserved_from') }}</th>
                            <th>{{ trans('reservations.reserved_to') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ optional($reservation->primaryDriver)->fullname }}</td>
                            <td>{{ optional($reservation->vehicle)->name }}</td>
                            <td>{{ $reservation->reserved_from->format(config('app.date_out_format')) }}</td>
                            <td>{{ $reservation->reserved_to->format(config('app.date_out_format')) }}</td>
                            <td>

                                <div class="btn-group btn-group-sm pull-right" role="group">

                                    <a href="{{ route('reservation_pickups.reservation_pickup.pickup', $reservation->id ) }}" class="btn btn-primary" title="{{ trans('reservations.pickup') }}">
                                        <span class="glyphicon glyphicon-road" aria-hidden="true"></span> {{ trans('reservations.show_pickup') }}
                                    </a>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $reservations->render() !!}
        </div>

        @endif

    </div>
@endsection
