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
                <h4 class="mt-5 mb-5">{{ trans('vehicles.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('vehicles.vehicle.create') }}" class="btn btn-success" title="{{ trans('vehicles.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($vehicles) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('vehicles.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('vehicles.name') }}</th>
                            <th>{{ trans('vehicles.size_id') }}</th>
                            <th>{{ trans('vehicles.brand_id') }}</th>
                            <th>{{ trans('vehicles.model') }}</th>
                            <th>{{ trans('vehicles.last_oil_change') }}</th>
                            <th>{{ trans('vehicles.miles_to_oil_change') }}</th>
                            <th>{{ trans('vehicles.current_miles') }}</th>
                            <th>{{ trans('vehicles.registration_experation_on') }}</th>
                            <th>{{ trans('vehicles.insurance_experation_on') }}</th>
                            <th>{{ trans('vehicles.daily_rate') }}</th>
                            <th>{{ trans('vehicles.weekly_rate') }}</th>
                            <th>{{ trans('vehicles.monthly_rate') }}</th>
                            <th>{{ trans('vehicles.is_active') }}</th>
                            <th>{{ trans('vehicles.purchase_cost') }}</th>
                            <th>Purchased Date</th>
                            <th>Sold Date</th>
                            <th>Sold Amount</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->name }}</td>
                            <td>{{ optional($vehicle->size)->name }}</td>
                            <td>{{ optional($vehicle->brand)->name }}</td>
                            <td>{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->last_oil_change }}</td>
                            <td>{{ $vehicle->miles_to_oil_change }}</td>
                            <td>{{ $vehicle->current_miles }}</td>
                            <td>{{ $vehicle->registration_experation_on }}</td>
                            <td>{{ $vehicle->insurance_experation_on }}</td>
                            <td>{{ $vehicle->daily_rate }}</td>
                            <td>{{ $vehicle->weekly_rate }}</td>
                            <td>{{ $vehicle->monthly_rate }}</td>
                            <td>{{ ($vehicle->is_active) ? 'Yes' : 'No' }}</td>
                            <td>{{ $vehicle->purchase_cost }}</td>
                            <td>{{ $vehicle->purchased_date }}</td>
                            <td>{{ $vehicle->sold_date }}</td>
                            <td>{{ $vehicle->sold_amount }}</td>

                            <td>

                                <form method="POST" action="{!! route('vehicles.vehicle.destroy', $vehicle->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('vehicles.vehicle.show', $vehicle->id ) }}" class="btn btn-info" title="{{ trans('vehicles.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('vehicles.vehicle.edit', $vehicle->id ) }}" class="btn btn-primary" title="{{ trans('vehicles.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('vehicles.delete') }}" onclick="return confirm(&quot;{{ trans('vehicles.confirm_delete') }}&quot;)">
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
            {!! $vehicles->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection