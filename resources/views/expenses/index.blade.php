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
                <h4 class="mt-5 mb-5">{{ trans('expenses.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('expenses.expense.create') }}" class="btn btn-success" title="{{ trans('expenses.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($expenses) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('expenses.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('expenses.related_date') }}</th>
                            <th>{{ trans('expenses.amount') }}</th>
                            <th>{{ trans('expenses.category_id') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $expense->related_date }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ optional($expense->category)->Name }}</td>

                            <td>

                                <form method="POST" action="{!! route('expenses.expense.destroy', $expense->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('expenses.expense.show', $expense->id ) }}" class="btn btn-info" title="{{ trans('expenses.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('expenses.expense.edit', $expense->id ) }}" class="btn btn-primary" title="{{ trans('expenses.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('expenses.delete') }}" onclick="return confirm(&quot;{{ trans('expenses.confirm_delete') }}&quot;)">
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
            {!! $expenses->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection