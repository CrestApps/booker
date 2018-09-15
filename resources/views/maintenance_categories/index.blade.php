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
                <h4 class="mt-5 mb-5">{{ trans('maintenance_categories.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('maintenance_categories.maintenance_category.create') }}" class="btn btn-success" title="{{ trans('maintenance_categories.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($maintenanceCategories) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('maintenance_categories.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('maintenance_categories.name') }}</th>
                            <th>{{ trans('maintenance_categories.is_active') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($maintenanceCategories as $maintenanceCategory)
                        <tr>
                            <td>{{ $maintenanceCategory->name }}</td>
                            <td>{{ ($maintenanceCategory->is_active) ? 'Yes' : 'No' }}</td>

                            <td>

                                <form method="POST" action="{!! route('maintenance_categories.maintenance_category.destroy', $maintenanceCategory->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('maintenance_categories.maintenance_category.show', $maintenanceCategory->id ) }}" class="btn btn-info" title="{{ trans('maintenance_categories.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('maintenance_categories.maintenance_category.edit', $maintenanceCategory->id ) }}" class="btn btn-primary" title="{{ trans('maintenance_categories.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('maintenance_categories.delete') }}" onclick="return confirm(&quot;{{ trans('maintenance_categories.confirm_delete') }}&quot;)">
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
            {!! $maintenanceCategories->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection