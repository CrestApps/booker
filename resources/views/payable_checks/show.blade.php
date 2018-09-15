@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Payable Check' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('payable_checks.payable_check.destroy', $payableCheck->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('payable_checks.payable_check.index') }}" class="btn btn-primary" title="{{ trans('payable_checks.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('payable_checks.payable_check.create') }}" class="btn btn-success" title="{{ trans('payable_checks.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('payable_checks.payable_check.edit', $payableCheck->id ) }}" class="btn btn-primary" title="{{ trans('payable_checks.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('payable_checks.delete') }}" onclick="return confirm(&quot;{{ trans('payable_checks.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('payable_checks.number') }}</dt>
            <dd>{{ $payableCheck->number }}</dd>
            <dt>{{ trans('payable_checks.value') }}</dt>
            <dd>{{ $payableCheck->value }}</dd>
            <dt>{{ trans('payable_checks.due_date') }}</dt>
            <dd>{{ $payableCheck->due_date }}</dd>
            <dt>{{ trans('payable_checks.issue_date') }}</dt>
            <dd>{{ $payableCheck->issue_date }}</dd>
            <dt>{{ trans('payable_checks.expense_id') }}</dt>
            <dd>{{ optional($payableCheck->expense)->id }}</dd>
            <dt>{{ trans('payable_checks.is_cashed') }}</dt>
            <dd>{{ ($payableCheck->is_cashed) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection