
<div class="form-group {{ $errors->has('credit_id') ? 'has-error' : '' }}">
    <label for="credit_id" class="col-md-2 control-label">Credit</label>
    <div class="col-md-10">
        <select class="form-control" id="credit_id" name="credit_id">
        	    <option value="" style="display: none;" {{ old('credit_id', optional($reservationToCredit)->credit_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select credit</option>
        	@foreach ($credits as $key => $credit)
			    <option value="{{ $key }}" {{ old('credit_id', optional($reservationToCredit)->credit_id) == $key ? 'selected' : '' }}>
			    	{{ $credit }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('credit_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('reservation_id') ? 'has-error' : '' }}">
    <label for="reservation_id" class="col-md-2 control-label">Reservation</label>
    <div class="col-md-10">
        <select class="form-control" id="reservation_id" name="reservation_id">
        	    <option value="" style="display: none;" {{ old('reservation_id', optional($reservationToCredit)->reservation_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select reservation</option>
        	@foreach ($reservations as $key => $reservation)
			    <option value="{{ $key }}" {{ old('reservation_id', optional($reservationToCredit)->reservation_id) == $key ? 'selected' : '' }}>
			    	{{ $reservation }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('reservation_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

