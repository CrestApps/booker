<form action="{{ route('languages.set') }}" class="navbar-form navbar-right" method="post" id="GlobalLanguagesForm">
	{{ csrf_field() }}
	<div class="form-group">
	    <label class="sr-only" for="GlobalLanguagesMenu">Client</label>
        <select class="form-control" id="GlobalLanguagesMenu" name="language">
        	@foreach($languages as $key => $language)
        	<option value="{{ $key }}" {{ ($key == $currentLanguage) ? 'selected' : '' }}>{{ $language }}</option>
        	@endforeach
		</select>
	</div>
</form>