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
                <h4 class="mt-5 mb-5">{{ trans('checks.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

            </div>

        </div>

        @if(count($checks) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('checks.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('checks.customer_id') }}</th>
                            <th>{{ trans('checks.total') }}</th>
                            <th>{{ trans('checks.due_date') }}</th>
                            <th>{{ trans('checks.status') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($checks as $check)
                        <tr>
                            <td>{{ optional($check->customer)->fullname }}</td>
                            <td>{{ $check->total }}</td>
                            <td>{{ optional($check->due_date)->format(config('app.date_out_format')) }}</td>
                            <td>{{ $check->status }}</td>

                            <td>

                                <form method="POST" action="{!! route('checks.check.destroy', $check->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('checks.check.show', $check->id ) }}" class="btn btn-info" title="{{ trans('checks.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('checks.check.edit', $check->id ) }}" class="btn btn-primary" title="{{ trans('checks.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('checks.delete') }}" onclick="return confirm(&quot;{{ trans('checks.confirm_delete') }}&quot;)">
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
            {!! $checks->render() !!}
        </div>

        @endif

    </div>
@endsection
