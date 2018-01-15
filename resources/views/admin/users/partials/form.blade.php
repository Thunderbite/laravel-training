{{ csrf_field() }}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Name</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name or old('name') }}" required>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email or old('email') }}" required>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

@if( isset($user) && $user->id == Auth::user()->id )

	<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	    <label for="password" class="col-md-4 control-label">New password</label>

	    <div class="col-md-6">
	        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">

	        @if ($errors->has('password'))
	            <span class="help-block">
	                <strong>{{ $errors->first('password') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	    <label for="password_confirmation" class="col-md-4 control-label">Password confirmation</label>

	    <div class="col-md-6">
	        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">

	        @if ($errors->has('password_confirmation'))
	            <span class="help-block">
	                <strong>{{ $errors->first('password_confirmation') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>
@endif

@if( !isset($user) )
<div class="form-group">
    <div class="col-md-offset-4 col-sm-6">
        <p>A password will be automatically generated.</p>
    </div>
</div>
@endif