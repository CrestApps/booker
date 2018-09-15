@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Check' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('checks.check.destroy', $check->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('checks.check.index') }}" class="btn btn-primary" title="{{ trans('checks.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('checks.check.create') }}" class="btn btn-success" title="{{ trans('checks.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('checks.check.edit', $check->id ) }}" class="btn btn-primary" title="{{ trans('checks.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('checks.delete') }}" onclick="return confirm(&quot;{{ trans('checks.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('checks.customer_id') }}</dt>
            <dd>{{ optional($check->customer)->fullname }}</dd>
            <dt>{{ trans('checks.total') }}</dt>
            <dd>{{ $check->total }}</dd>
            <dt>{{ trans('checks.due_date') }}</dt>
            <dd>{{ $check->due_date }}</dd>
            <dt>{{ trans('checks.status') }}</dt>
            <dd>{{ $check->status }}</dd>
            <dt>Reservation</dt>
            <dd>{{ optional($check->reservation)->created_at }}</dd>

        </dl>

    </div>
</div>

@endsection