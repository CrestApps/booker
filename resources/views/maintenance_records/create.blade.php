@extends('layouts.app')

@section('content')

    <div class="panel panel-default" id="maintenance_records_create_page">

        <div class="panel-heading clearfix">

            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('maintenance_records.create') }}</h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('maintenance_records.maintenance_record.index') }}" class="btn btn-primary" title="{{ trans('maintenance_records.show_all') }}">
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

            <form method="POST" action="{{ route('maintenance_records.maintenance_record.store') }}" accept-charset="UTF-8" id="create_maintenance_record_form" name="create_maintenance_record_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('maintenance_records.form', ['maintenanceRecord' => null])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('maintenance_records.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
