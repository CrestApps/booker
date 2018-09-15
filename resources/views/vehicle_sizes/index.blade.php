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
                <h4 class="mt-5 mb-5">{{ trans('vehicle_sizes.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('vehicle_sizes.vehicle_size.create') }}" class="btn btn-success" title="{{ trans('vehicle_sizes.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($vehicleSizes) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('vehicle_sizes.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('vehicle_sizes.name') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($vehicleSizes as $vehicleSize)
                        <tr>
                            <td>{{ $vehicleSize->name }}</td>

                            <td>

                                <form method="POST" action="{!! route('vehicle_sizes.vehicle_size.destroy', $vehicleSize->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('vehicle_sizes.vehicle_size.show', $vehicleSize->id ) }}" class="btn btn-info" title="{{ trans('vehicle_sizes.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('vehicle_sizes.vehicle_size.edit', $vehicleSize->id ) }}" class="btn btn-primary" title="{{ trans('vehicle_sizes.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('vehicle_sizes.delete') }}" onclick="return confirm(&quot;{{ trans('vehicle_sizes.confirm_delete') }}&quot;)">
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
            {!! $vehicleSizes->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection