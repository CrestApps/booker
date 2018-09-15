@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Customer' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('customers.customer.destroy', $customer->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('customers.customer.index') }}" class="btn btn-primary" title="{{ trans('customers.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('customers.customer.create') }}" class="btn btn-success" title="{{ trans('customers.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('customers.customer.edit', $customer->id ) }}" class="btn btn-primary" title="{{ trans('customers.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('customers.delete') }}" onclick="return confirm(&quot;{{ trans('customers.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('customers.fullname') }}</dt>
            <dd>{{ $customer->fullname }}</dd>
            <dt>{{ trans('customers.home_address') }}</dt>
            <dd>{{ $customer->home_address }}</dd>
            <dt>{{ trans('customers.personal_identification_number') }}</dt>
            <dd>{{ $customer->personal_identification_number }}</dd>
            <dt>{{ trans('customers.driver_license_number') }}</dt>
            <dd>{{ $customer->driver_license_number }}</dd>
            <dt>{{ trans('customers.birth_date') }}</dt>
            <dd>{{ $customer->birth_date }}</dd>
            <dt>{{ trans('customers.driver_license_issue_date') }}</dt>
            <dd>{{ $customer->driver_license_issue_date }}</dd>
            <dt>{{ trans('customers.driver_license_experation_date') }}</dt>
            <dd>{{ $customer->driver_license_experation_date }}</dd>
            <dt>{{ trans('customers.phone') }}</dt>
            <dd>{{ $customer->phone }}</dd>
            <dt>{{ trans('customers.is_black_listed') }}</dt>
            <dd>{{ ($customer->is_black_listed) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('customers.black_list_notes') }}</dt>
            <dd>{{ $customer->black_list_notes }}</dd>

        </dl>

    </div>
</div>

@endsection