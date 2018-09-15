@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Reservation To Credit' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('reservation_to_credits.reservation_to_credit.destroy', $reservationToCredit->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('reservation_to_credits.reservation_to_credit.index') }}" class="btn btn-primary" title="Show All Reservation To Credit">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('reservation_to_credits.reservation_to_credit.create') }}" class="btn btn-success" title="Create New Reservation To Credit">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('reservation_to_credits.reservation_to_credit.edit', $reservationToCredit->id ) }}" class="btn btn-primary" title="Edit Reservation To Credit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Reservation To Credit" onclick="return confirm(&quot;Click Ok to delete Reservation To Credit.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Credit</dt>
            <dd>{{ optional($reservationToCredit->credit)->created_at }}</dd>
            <dt>Reservation</dt>
            <dd>{{ optional($reservationToCredit->reservation)->created_at }}</dd>

        </dl>

    </div>
</div>

@endsection