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
                <h4 class="mt-5 mb-5">{{ trans('reservations.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('reservations.reservation.create') }}" class="btn btn-success" title="{{ trans('reservations.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
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
                            <th>{{ trans('reservations.status') }}</th>

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
                            <td>{{ $reservation->status }}</td>

                            <td>

                                <form method="POST" action="{!! route('reservations.reservation.destroy', $reservation->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('reservations.reservation.show', $reservation->id ) }}" class="btn btn-info" title="{{ trans('reservations.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('reservations.reservation.edit', $reservation->id ) }}" class="btn btn-primary" title="{{ trans('reservations.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('reservations.delete') }}" onclick="return confirm(&quot;{{ trans('reservations.confirm_delete') }}&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>

                                        @if($reservation->status == 'in-progress')
                                        <a href="{{ route('reservation_pickups.reservation_pickup.processed', $reservation->id ) }}" class="btn btn-warning" title="{{ trans('reservations.print') }}">
                                            <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                                        </a>
                                        @elseif($reservation->status == 'completed')
                                        <a href="{{ route('reservation_dropoffs.reservation_dropoff.processed', $reservation->id ) }}" class="btn btn-warning" title="{{ trans('reservations.print') }}">
                                            <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                                        </a>
                                        @endif

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
            {!! $reservations->render() !!}
        </div>

        @endif

    </div>
@endsection
