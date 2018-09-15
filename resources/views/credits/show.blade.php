@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Credit' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('credits.credit.destroy', $credit->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('credits.credit.index') }}" class="btn btn-primary" title="{{ trans('credits.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('credits.credit.create') }}" class="btn btn-success" title="{{ trans('credits.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('credits.credit.edit', $credit->id ) }}" class="btn btn-primary" title="{{ trans('credits.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('credits.delete') }}" onclick="return confirm(&quot;{{ trans('credits.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('credits.customer_id') }}</dt>
            <dd>{{ optional($credit->customer)->fullname }}</dd>
            <dt>{{ trans('credits.amount') }}</dt>
            <dd>{{ $credit->amount }}</dd>
            <dt>{{ trans('credits.due_date') }}</dt>
            <dd>{{ $credit->due_date }}</dd>

        </dl>

    </div>
</div>

@endsection