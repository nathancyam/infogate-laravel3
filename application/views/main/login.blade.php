{{ Form::open('login') }}
    <!-- check for login errors flash var -->
    <div class="control-group {{ $errors->has('username') ? 'error' : '' }}"></div>
    <div class="control-group {{ $errors->has('password') ? 'error' : '' }}"></div>

    <!-- Username field -->
    <p>{{ Form::label('username', 'Username') }}</p>
    <p>{{ Form::text('username') }}</p>

    <!-- Password field -->
    <p>{{ Form::label('password', 'Password') }}</p>
    <p>{{ Form::password('password') }}</p>

    <!-- submit button -->
    <p>{{ Form::submit('Login') }}</p>

{{ Form::close() }}
