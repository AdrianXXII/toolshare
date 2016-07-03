{{--/**
 * Created by PhpStorm.
 * User: reto
 * Date: 03.07.16
 * Time: 17:04
 */--}}

@extends('layouts.master')

@section('content')
<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>
@endsection