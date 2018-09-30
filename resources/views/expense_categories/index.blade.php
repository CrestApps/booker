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
                <h4 class="mt-5 mb-5">{{ trans('expense_categories.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('expense_categories.expense_category.create') }}" class="btn btn-success" title="{{ trans('expense_categories.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($expenseCategories) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('expense_categories.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('expense_categories.name') }}</th>
                            <th>{{ trans('expense_categories.sort') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($expenseCategories as $expenseCategory)
                        <tr>
                            <td>{{ $expenseCategory->name }}</td>
                            <td>{{ $expenseCategory->sort }}</td>

                            <td>

                                <form method="POST" action="{!! route('expense_categories.expense_category.destroy', $expenseCategory->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('expense_categories.expense_category.show', $expenseCategory->id ) }}" class="btn btn-info" title="{{ trans('expense_categories.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('expense_categories.expense_category.edit', $expenseCategory->id ) }}" class="btn btn-primary" title="{{ trans('expense_categories.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('expense_categories.delete') }}" onclick="return confirm(&quot;{{ trans('expense_categories.confirm_delete') }}&quot;)">
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
            {!! $expenseCategories->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection