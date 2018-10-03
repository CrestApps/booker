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

        @if(!isset($assets) || count($assets) == 0)
        <div class="panel-body">
            <div class="panel-body text-center">
                <h4>{{ trans('reports.no_available_records') }}</h4>
            </div>
        </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('assets.title') }}</th>
                            <th class="text-center">{{ trans('assets.cost') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($assets) && $assets)
	                    @foreach($assets as $asset)
	                        <tr>
	                            <td>{{ $asset->name }}</td>
	                            <td class="text-center">{{ $asset->cost }}</td>
	                        </tr>
	                    @endforeach
                    @endif
                    </tbody>

                    @if(isset($assets) && $assets)
                    <tfoot>
                    	<tr>
                    		<td></td>
                    		<td class="text-center">{{ $assets->sum('cost') }}</td>
                    	</tr>
                    </tfoot>
                    @endif
                </table>

            </div>
        </div>

        @endif

    </div>
@endsection
