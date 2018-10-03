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

        @if(!isset($records) || count($records) == 0)
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
                            <th class="text-center">#</th>
                            <th>{{ trans('customers.fullname') }}</th>
                            <th class="text-center">{{ trans('reports.count_reservations')}}</th>
                            <th class="text-center">{{ trans('reports.total_rent')}}</th>
                            <th class="text-center">{{ trans('reports.average_rent')}}</th>
                        </tr>
                    </thead>
                    <tbody>
	                    @foreach($records ?? [] as $key => $record)
	                        <tr>
	                            <td class="text-center">{{ $key+1 }}</td>
                                <td>{{ $record->fullname }}</td>
                                <td class="text-center">{{ $record->reservation_count }}</td>
                                <td class="text-center">{{ $record->total_rent }}</td>
	                            <td class="text-center">{{ $record->average_rent }}</td>
	                        </tr>
	                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        @endif

    </div>
@endsection
