{{ Form::open('login') }}
    <!-- check for login errors flash var -->
    @if (Session::has('login_errors'))
        <span class="error">Username or password incorrect.</span>
    @endif

    <!-- username field -->
    <p>{{ Form::label('username', 'Username') }}</p>
    <p>{{ Form::text('username') }}</p>
    <p>{{ Form::inline_help('*') }}</p>

    <!-- password field -->
    <p>{{ Form::label('password', 'Password') }}</p>
    <p>{{ Form::password('password') }}</p>

    <!-- submit button -->
    <p>{{ Form::submit('Login') }}</p>

{{ Form::close() }}

<?php echo Form::control_group(Form::label('inputError', 'Input with error'),
   Form::text('inputError'), 'error',
   Form::inline_help('Please correct the error')); ?>
