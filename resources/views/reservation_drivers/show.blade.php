@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Reservation Driver' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('reservation_drivers.reservation_driver.destroy', $reservationDriver->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('reservation_drivers.reservation_driver.index') }}" class="btn btn-primary" title="{{ trans('reservation_drivers.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('reservation_drivers.reservation_driver.create') }}" class="btn btn-success" title="{{ trans('reservation_drivers.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('reservation_drivers.reservation_driver.edit', $reservationDriver->id ) }}" class="btn btn-primary" title="{{ trans('reservation_drivers.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('reservation_drivers.delete') }}" onclick="return confirm(&quot;{{ trans('reservation_drivers.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('reservation_drivers.reservation_id') }}</dt>
            <dd>{{ optional($reservationDriver->reservation)->id }}</dd>
            <dt>{{ trans('reservation_drivers.driver_id') }}</dt>
            <dd>{{ optional($reservationDriver->driver)->fullname }}</dd>

        </dl>

    </div>
</div>

@endsection