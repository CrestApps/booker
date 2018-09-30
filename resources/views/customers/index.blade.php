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
                <h4 class="mt-5 mb-5">{{ trans('customers.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('customers.customer.create') }}" class="btn btn-success" title="{{ trans('customers.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        <div class="panel-footer clearfix">
            <div class="pull-right">
                <form method="GET" action="{{ route('customers.customer.search') }}" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                       <label for="search_term" class="sr-only">Search for:</label>
                       <input type="text" name="term" class="form-control" id="search_term" value="{{ old('term', $term) }}" placeholder="Search customer...">
                    </div>

                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>
        </div>

        @if(count($customers) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('customers.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('customers.fullname') }}</th>
                            <th>{{ trans('customers.personal_identification_number') }}</th>
                            <th>{{ trans('customers.phone') }}</th>
                            <th>{{ trans('customers.is_black_listed') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->fullname }}</td>
                            <td>{{ $customer->personal_identification_number }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ ($customer->is_black_listed) ? 'Yes' : 'No' }}</td>

                            <td>

                                <form method="POST" action="{!! route('customers.customer.destroy', $customer->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('customers.customer.show', $customer->id ) }}" class="btn btn-info" title="{{ trans('customers.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('customers.customer.edit', $customer->id ) }}" class="btn btn-primary" title="{{ trans('customers.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('customers.delete') }}" onclick="return confirm(&quot;{{ trans('customers.confirm_delete') }}&quot;)">
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
            {!! $customers->render() !!}
        </div>

        @endif

    </div>
@endsection
