@extends('_base')
@section('body')

<h1>Sign up</h1>

{{ Form::open(array('url' => '/signup')) }}
	
	Name:<br>
    {{ Form::text('name') }}<br><br>

    Email<br>
    {{ Form::text('email') }}<br><br>

    Password:<br>
    {{ Form::password('password') }}<br><br>

    {{ Form::submit('Submit') }}

{{ Form::close() }}

@stop