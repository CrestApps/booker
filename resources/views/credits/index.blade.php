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
                <h4 class="mt-5 mb-5">{{ trans('credits.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

            </div>

        </div>

        <div class="panel-footer clearfix">
            <div class="pull-right">
                <form method="GET" action="{{ route('credits.credit.search') }}" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                       <label for="search_term" class="sr-only">Search for:</label>
                       <input type="text" name="term" class="form-control" id="search_term" value="{{ old('term', $term) }}" placeholder="Search customer...">
                    </div>

                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>
        </div>


        @if(count($credits) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('credits.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('credits.customer_id') }}</th>
                            <th>{{ trans('credits.amount') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($credits as $credit)
                        <tr>
                            <td>{{ optional($credit->customer)->fullname }}</td>
                            <td>{{ $credit->amount }}</td>

                            <td>
                                <div class="btn-group btn-group-xs pull-right" role="group">

                                    <a href="{{ route('credits.credit.show', $credit->id ) }}" class="btn btn-info" title="{{ trans('credits.show') }}">
                                        <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $credits->render() !!}
        </div>

        @endif

    </div>
@endsection
