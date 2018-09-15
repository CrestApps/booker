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
                <h4 class="mt-5 mb-5">{{ trans('reservation_drivers.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('reservation_drivers.reservation_driver.create') }}" class="btn btn-success" title="{{ trans('reservation_drivers.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($reservationDrivers) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('reservation_drivers.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('reservation_drivers.reservation_id') }}</th>
                            <th>{{ trans('reservation_drivers.driver_id') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reservationDrivers as $reservationDriver)
                        <tr>
                            <td>{{ optional($reservationDriver->reservation)->id }}</td>
                            <td>{{ optional($reservationDriver->driver)->fullname }}</td>

                            <td>

                                <form method="POST" action="{!! route('reservation_drivers.reservation_driver.destroy', $reservationDriver->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('reservation_drivers.reservation_driver.show', $reservationDriver->id ) }}" class="btn btn-info" title="{{ trans('reservation_drivers.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('reservation_drivers.reservation_driver.edit', $reservationDriver->id ) }}" class="btn btn-primary" title="{{ trans('reservation_drivers.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('reservation_drivers.delete') }}" onclick="return confirm(&quot;{{ trans('reservation_drivers.confirm_delete') }}&quot;)">
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
            {!! $reservationDrivers->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection