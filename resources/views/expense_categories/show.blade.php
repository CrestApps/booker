@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($expenseCategory->title) ? $expenseCategory->title : 'Expense Category' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('expense_categories.expense_category.destroy', $expenseCategory->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('expense_categories.expense_category.index') }}" class="btn btn-primary" title="{{ trans('expense_categories.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('expense_categories.expense_category.create') }}" class="btn btn-success" title="{{ trans('expense_categories.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('expense_categories.expense_category.edit', $expenseCategory->id ) }}" class="btn btn-primary" title="{{ trans('expense_categories.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('expense_categories.delete') }}" onclick="return confirm(&quot;{{ trans('expense_categories.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('expense_categories.title') }}</dt>
            <dd>{{ $expenseCategory->title }}</dd>
            <dt>{{ trans('expense_categories.sort') }}</dt>
            <dd>{{ $expenseCategory->sort }}</dd>

        </dl>

    </div>
</div>

@endsection