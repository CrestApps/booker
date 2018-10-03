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
    		<div class="pull-right">
    		@foreach(config('app.locales') as $key => $language)
        		<button class="btn btn-primary print-button" role="button" data-target-print="#print_section_{{ $key }}">
        			<span class="glyphicon glyphicon-print" /> {{ trans("lang.print_$key") }}
        		</button>
        	@endforeach
    		</div>
    	</div>


    	<div class="panel-body">

    		@foreach(config('app.locales') as $key => $language)
    		<div class="well width-700 print-containers {{ App::getLocale() != $key ? 'hidden' : '' }}" id="print_section_{{ $key }}" style="margin: auto;">

                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h4>{{ \Lang::get('contract.business_info' ,[], $key) }}</h4>
                    </div>
                </div>

    			<div class="row">
                    <div class="col-xs-push-2 col-xs-pull-2 col-xs-8">
                		<dl class="dl-horizontal">
                			<dt>{{ \Lang::get('contract.business_id' ,[], $key) }}</dt>
                			<dd>{{ config('booker.shop_id') }}</dd>
                			<dt>{{ \Lang::get('reservations.reservation_id' ,[], $key) }}</dt>
                			<dd>{{ $reservation->id }}</dd>
                			<dt>{{ \Lang::get('reservations.picked_up_at' ,[], $key) }}</dt>
                			<dd>{{ toDateTimeFormat($reservation->picked_up_at) }}</dd>
                		</dl>
                    </div>
    			</div>
                <div class="row">
                    <div class="col-xs-push-2 col-xs-pull-2 col-xs-8 text-center">
                        ----------------------------------------------------
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 text-center">
                        <h4>{{ \Lang::get('contract.renter_info', [], $key) }}</h4>
                    </div>

                    <div class="col-xs-6 text-center">
                        <h4>{{ \Lang::get('contract.vehicle_info', [], $key) }}</h4>
                    </div>
                </div>

                <div class="row">
                	<div class="col-xs-6">
                		<dl class="dl-horizontal">
                            <dt>{{ \Lang::get('customers.fullname', [], $key) }}</dt>
                            <dd>{{ $reservation->primaryDriver->fullname }}</dd>
                            <dt>{{ \Lang::get('customers.home_address', [], $key) }}</dt>
                            <dd>{{ $reservation->primaryDriver->home_address }}</dd>
                            <dt>{{ \Lang::get('customers.personal_identification_number', [], $key) }}</dt>
                            <dd>{{ $reservation->primaryDriver->personal_identification_number }}</dd>
                            <dt>{{ \Lang::get('customers.driver_license_number', [], $key) }}</dt>
                            <dd>{{ $reservation->primaryDriver->driver_license_number }}</dd>
                            <dt>{{ \Lang::get('customers.birth_date', [], $key) }}</dt>
                            <dd>{{ $reservation->primaryDriver->birth_date->format(config('app.date_out_format' ,[], $key)) }}</dd>
                            <dt>{{ \Lang::get('customers.driver_license_issue_date', [], $key) }}</dt>
                            <dd>{{ toDateFormat($reservation->primaryDriver->driver_license_issue_date) }}</dd>
                            <dt>{{ \Lang::get('customers.driver_license_experation_date', [], $key) }}</dt>
                            <dd>{{ toDateFormat($reservation->primaryDriver->driver_license_experation_date) }}</dd>
                            <dt>{{ \Lang::get('customers.phone', [], $key) }}</dt>
                            <dd>{{ $reservation->primaryDriver->phone }}</dd>
                        </dl>
                	</div>

                	<div class="col-xs-6">
                		<dl class="dl-horizontal">
                            <dt>{{ \Lang::get('vehicles.name', [], $key) }}</dt>
                            <dd>{{ $reservation->vehicle->name }}</dd>
                            <dt>{{ \Lang::get('vehicles.size', [], $key) }}</dt>
                            <dd>{{ optional($reservation->vehicle->size)->name }}</dd>
                            <dt>{{ \Lang::get('vehicles.brand_id', [], $key) }}</dt>
                            <dd>{{ optional($reservation->vehicle->brand)->name }}</dd>
                            <dt>{{ \Lang::get('vehicles.model', [], $key) }}</dt>
                            <dd>{{ $reservation->vehicle->model }}</dd>
                            <dt>{{ \Lang::get('vehicles.year', [], $key) }}</dt>
                            <dd>{{ $reservation->vehicle->year }}</dd>
                            <dt>{{ \Lang::get('vehicles.color', [], $key) }}</dt>
                            <dd>{{ $reservation->vehicle->color }}</dd>
                            <dt>{{ \Lang::get('vehicles.current_miles', [], $key) }}</dt>
                            <dd>{{ $reservation->vehicle->current_miles }}</dd>
                            <dt>{{ \Lang::get('vehicles.vin_number', [], $key) }}</dt>
                            <dd>{{ $reservation->vehicle->vin_number }}</dd>
                            <dt>{{ \Lang::get('vehicles.licence_plate', [], $key) }}</dt>
                            <dd>{{ $reservation->vehicle->licence_plate }}</dd>

                		</dl>
                	</div>
                </div>










                <div class="row">
                    <div class="col-xs-6 text-center">
                        <h4>{{ \Lang::get('contract.contract_length', [], $key) }}</h4>
                    </div>

                    <div class="col-xs-6 text-center">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <dl class="dl-horizontal">
                            <dt>{{ \Lang::get('reservations.total_days', [], $key) }}</dt>
                            <dd>{{ $reservation->total_days }}</dd>
                            <dt>{{ \Lang::get('reservations.reserved_from', [], $key) }}</dt>
                            <dd>{{ toDateFormat($reservation->reserved_from) }}</dd>
                            <dt>{{ \Lang::get('reservations.reserved_to', [], $key) }}</dt>
                            <dd>{{ toDateFormat($reservation->reserved_to) }}</dd>
                        </dl>
                    </div>

                    <div class="col-xs-6">
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h4>{{ \Lang::get('contract.thank_you_for_your_business', [], $key) }}</h4>
                    </div>
                </div>

            </div>
            @endforeach
    	</div>


    </div>
@endsection
