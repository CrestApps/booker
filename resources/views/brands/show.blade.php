@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($brand->name) ? $brand->name : 'Brand' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('brands.brand.destroy', $brand->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('brands.brand.index') }}" class="btn btn-primary" title="{{ trans('brands.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('brands.brand.create') }}" class="btn btn-success" title="{{ trans('brands.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('brands.brand.edit', $brand->id ) }}" class="btn btn-primary" title="{{ trans('brands.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('brands.delete') }}" onclick="return confirm(&quot;{{ trans('brands.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('brands.name') }}</dt>
            <dd>{{ $brand->name }}</dd>
            <dt>{{ trans('brands.notes') }}</dt>
            <dd>{{ $brand->notes }}</dd>

        </dl>

    </div>
</div>

@endsection