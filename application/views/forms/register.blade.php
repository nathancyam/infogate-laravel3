@layout('template.main')

{{ $title = 'Registration' }}
{{ $subtitle = 'New User' }}

@section('content')
    {{ $errors->first('fName', '<p class="error">A forename is required</p>') }}
    {{ $errors->first('sName', '<p class="error">A surname is required</p>') }}
    {{ $errors->first('email', '<p class="error">:message</p>') }}
    {{ $errors->first('password', '<p class="error">:message</p>') }}

    @if($isNew == true)
        {{ Form::open(URL::to_action('register@createuser')) }}

        <p>{{ Form::label('forename', 'First Name:') }}</p>
        <p>{{ Form::text('forename', Input::old('forename')) }}</p>

        <p>{{ Form::label('surname', 'Surname') }}</p>
        <p>{{ Form::text('surname', Input::old('surname')) }}</p>

        <p>{{ Form::label('password', 'Password') }}</p>
        <p>{{ Form::password('password') }}</p>
        <p>{{ Form::label('password_confirmation', 'Confirm Password') }}</p>
        <p>{{ Form::password('password_confirmation') }}</p>

        <p>{{ Form::label('email', 'E-mail') }}</p>
        <p>{{ Form::email('email') }}</p>

        <p>{{ Form::label('enrollment', 'Course Enrollment') }}</p>
        {{ Form::select('enrollment', array($courses)) }}

        <p>{{ Form::label('role', 'Role') }}</p>
        {{ Form::select('role', array('student'=>'Student')) }}

        <p>{{ Form::submit('Sign Up') }}</p>

        {{ Form::close() }}
    @else
        {{ Form::open(URL::to_action('account@postupdate')) }}

        <p>{{ Form::label('forename', 'First Name:') }}</p>
        <p>{{ Form::text('forename', Input::old('forename', $user->fname)) }}</p>

        <p>{{ Form::label('surname', 'Surname') }}</p>
        <p>{{ Form::text('surname', Input::old('surname', $user->sname)) }}</p>

        <p>{{ Form::label('email', 'E-mail') }}</p>
        <p>{{ Form::email('email', $user->email) }}</p>

        <p>{{ Form::submit('Save Changes') }}</p>

        {{ Form::close() }}
    @endif
{{ HTML::style('css/register.css') }}
@endsection
