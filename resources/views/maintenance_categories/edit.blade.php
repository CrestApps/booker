@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($maintenanceCategory->name) ? $maintenanceCategory->name : 'Maintenance Category' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('maintenance_categories.maintenance_category.index') }}" class="btn btn-primary" title="{{ trans('maintenance_categories.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('maintenance_categories.maintenance_category.create') }}" class="btn btn-success" title="{{ trans('maintenance_categories.create') }}">
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

            <form method="POST" action="{{ route('maintenance_categories.maintenance_category.update', $maintenanceCategory->id) }}" id="edit_maintenance_category_form" name="edit_maintenance_category_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('maintenance_categories.form', [
                                        'maintenanceCategory' => $maintenanceCategory,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('maintenance_categories.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection