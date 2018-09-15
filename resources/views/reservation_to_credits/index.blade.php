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
                <h4 class="mt-5 mb-5">Reservation To Credits</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('reservation_to_credits.reservation_to_credit.create') }}" class="btn btn-success" title="Create New Reservation To Credit">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($reservationToCredits) == 0)
            <div class="panel-body text-center">
                <h4>No Reservation To Credits Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Credit</th>
                            <th>Reservation</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reservationToCredits as $reservationToCredit)
                        <tr>
                            <td>{{ optional($reservationToCredit->credit)->created_at }}</td>
                            <td>{{ optional($reservationToCredit->reservation)->created_at }}</td>

                            <td>

                                <form method="POST" action="{!! route('reservation_to_credits.reservation_to_credit.destroy', $reservationToCredit->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('reservation_to_credits.reservation_to_credit.show', $reservationToCredit->id ) }}" class="btn btn-info" title="Show Reservation To Credit">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('reservation_to_credits.reservation_to_credit.edit', $reservationToCredit->id ) }}" class="btn btn-primary" title="Edit Reservation To Credit">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Reservation To Credit" onclick="return confirm(&quot;Click Ok to delete Reservation To Credit.&quot;)">
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
            {!! $reservationToCredits->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection