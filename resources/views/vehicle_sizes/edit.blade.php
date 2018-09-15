@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($vehicleSize->name) ? $vehicleSize->name : 'Vehicle Size' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('vehicle_sizes.vehicle_size.index') }}" class="btn btn-primary" title="{{ trans('vehicle_sizes.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('vehicle_sizes.vehicle_size.create') }}" class="btn btn-success" title="{{ trans('vehicle_sizes.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
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

            <form method="POST" action="{{ route('vehicle_sizes.vehicle_size.update', $vehicleSize->id) }}" id="edit_vehicle_size_form" name="edit_vehicle_size_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('vehicle_sizes.form', [
                                        'vehicleSize' => $vehicleSize,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('vehicle_sizes.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection