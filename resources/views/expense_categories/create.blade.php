@extends('layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('expense_categories.create') }}</h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('expense_categories.expense_category.index') }}" class="btn btn-primary" title="{{ trans('expense_categories.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('expense_categories.expense_category.store') }}" accept-charset="UTF-8" id="create_expense_category_form" name="create_expense_category_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('expense_categories.form', [
                                        'expenseCategory' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('expense_categories.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


