<!doctype html>
<html>
<head>
<title>Look at me Login</title>
</head>
    <style>
        body {
            font-family:Arial;
        }
        
        #loginForm {
            text-align: center;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            width: 60%;
            margin: 0 auto;
        }
        
    </style>
<body>

{{ Form::open(array('url' => 'admin','id' => 'loginForm')) }}
<h1>Login</h1>

<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('email') }}
    {{ $errors->first('password') }}
</p>

<p>
    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email', null, array('placeholder' => 'awesome@awesome.com')) }}
</p>

<p>
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}
</p>

<p>{{ Form::submit('Submit!') }}</p>
{{ Form::close() }}