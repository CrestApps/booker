@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($asset->name) ? $asset->name : 'Asset' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('assets.asset.destroy', $asset->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('assets.asset.index') }}" class="btn btn-primary" title="{{ trans('assets.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('assets.asset.create') }}" class="btn btn-success" title="{{ trans('assets.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('assets.asset.edit', $asset->id ) }}" class="btn btn-primary" title="{{ trans('assets.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('assets.delete') }}" onclick="return confirm(&quot;{{ trans('assets.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('assets.name') }}</dt>
            <dd>{{ $asset->name }}</dd>
            <dt>{{ trans('assets.category_id') }}</dt>
            <dd>{{ optional($asset->category)->name }}</dd>
            <dt>{{ trans('assets.cost') }}</dt>
            <dd>{{ $asset->cost }}</dd>
            <dt>{{ trans('assets.purchased_at') }}</dt>
            <dd>{{ toDateTimeFormat($asset->purchased_at) }}</dd>
            <dt>{{ trans('assets.notes') }}</dt>
            <dd>{{ $asset->notes }}</dd>

        </dl>

    </div>
</div>

@endsection
