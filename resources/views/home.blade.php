@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">{{ trans('lang.dashboard') }}</div>

    <div class="panel-body">
        {{ trans('lang.you_are_logged_in') }}
    </div>
</div>
@endsection
