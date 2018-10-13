@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Expense' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('expenses.expense.destroy', $expense->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('expenses.expense.index') }}" class="btn btn-primary" title="{{ trans('expenses.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('expenses.expense.create') }}" class="btn btn-success" title="{{ trans('expenses.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('expenses.expense.edit', $expense->id ) }}" class="btn btn-primary" title="{{ trans('expenses.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('expenses.delete') }}" onclick="return confirm(&quot;{{ trans('expenses.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('expenses.category_id') }}</dt>
            <dd>{{ optional($expense->category)->name }}</dd>
            <dt>{{ trans('expenses.related_date') }}</dt>
            <dd>{{ $expense->related_date }}</dd>
            <dt>{{ trans('expenses.amount') }}</dt>
            <dd>{{ $expense->amount }}</dd>
            <dt>Pay Date</dt>
            <dd>{{ $expense->pay_date }}</dd>
            <dt>{{ trans('expenses.notes') }}</dt>
            <dd>{{ $expense->notes }}</dd>

        </dl>

    </div>
</div>

@endsection