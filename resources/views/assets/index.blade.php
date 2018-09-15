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
                <h4 class="mt-5 mb-5">{{ trans('assets.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('assets.asset.create') }}" class="btn btn-success" title="{{ trans('assets.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($assets) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('assets.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('assets.name') }}</th>
                            <th>{{ trans('assets.category_id') }}</th>
                            <th>{{ trans('assets.cost') }}</th>
                            <th>{{ trans('assets.purchased_at') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($assets as $asset)
                        <tr>
                            <td>{{ $asset->name }}</td>
                            <td>{{ optional($asset->category)->name }}</td>
                            <td>{{ $asset->cost }}</td>
                            <td>{{ $asset->purchased_at }}</td>

                            <td>

                                <form method="POST" action="{!! route('assets.asset.destroy', $asset->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('assets.asset.show', $asset->id ) }}" class="btn btn-info" title="{{ trans('assets.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('assets.asset.edit', $asset->id ) }}" class="btn btn-primary" title="{{ trans('assets.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('assets.delete') }}" onclick="return confirm(&quot;{{ trans('assets.confirm_delete') }}&quot;)">
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
            {!! $assets->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection