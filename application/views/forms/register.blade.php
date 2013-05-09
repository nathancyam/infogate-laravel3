@layout('template.main')

@section('content')
    {{ Form::open('user/new') }}

    {{ $errors->first('fName', '<p class="error">:message</p>') }}
    <p>{{ Form::label('fName', 'First Name:') }}</p>
    <p>{{ Form::text('fName', Input::old('fName')) }}</p>

    {{ $errors->first('sName', '<p class="error">:message</p>') }}
    <p>{{ Form::label('sName', 'Surname') }}</p>
    <p>{{ Form::text('sName', Input::old('sName')) }}</p>


    {{ $errors->first('password', '<p class="error">:message</p>') }}

    <p>{{ Form::label('password', 'Password') }}</p>
    <p>{{ Form::password('password') }}</p>

    <p>{{ Form::label('passwordcheck', 'Re-type Password') }}</p>
    <p>{{ Form::password('passwordcheck') }}</p>

    {{ $errors->first('email', '<p class="error">:message</p>') }}
    <p>{{ Form::label('email', 'E-mail') }}</p>
    <p>{{ Form::email('email') }}</p>

    <p>{{ Form::submit('Sign Up') }}</p>

    {{ Form::close() }}
@endsection
