{{ Form::open(URL::to_route('postLogin')) }}
    @if (Session::has('login_errors'))
        <span class="error">Username or password incorrect.</span>
    @endif
    <!-- Username field -->
    <p>{{ Form::label('username', 'Username') }}</p>
    <p>{{ Form::text('username') }}</p>

    <!-- Password field -->
    <p>{{ Form::label('password', 'Password') }}</p>
    <p>{{ Form::password('password') }}</p>

    <!-- submit button -->
    <p>{{ Form::submit('Login') }} {{ Button::link(URL::to_action('register'), 'Register') }}</p>
{{ Form::close() }}
