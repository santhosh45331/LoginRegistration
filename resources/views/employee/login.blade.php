@extends('employee.layout')
@section('title','Login Page')
@section('head')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
<script src="{{asset('js/login.js')}}"></script>
@section('content')
<div class="container rounded-3 py-5" style="background-color:#EAE5FF; margin-top:30px;">
<div class="row  d-flex justify-content-center">
    <div class="col-md-9 text-bg-dark rounded-3">
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <strong>Error!</strong> <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
@endif
@if ($message = Session::get('Success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
@endif       
        <div class="row">
            <div class="col-md-6" style="padding:0px 80px 0px 80px;">
                <div class="brand-name mb-md-5 mt-2">
                <i class="fa-solid fa-face-smile" style="color: #ffffff;"></i>
                <small>Ecom ADS</small>
                </div>
                <div class="sub-text">
                    <span>Be part of this movement.</span>
                    <hr>
                </div>
                <h3>SIGNIN YOUR ACCOUNT</h3>
                <div class="relogin my-3">
                    <small>Create new account - <a href="{{ route('register') }}">Sign up</a></small>
                </div>
                <div class="form">
                    <form action="{{ route('authenticate') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" id="lemail" value="{{old('email')}}" class="form-control text-bg-secondary mb-3 rounded-3" placeholder="Email" autocomplete="email" autofocus>
                        </div>
                        <div class="form-group">
                            <input id="lpassword" type="password" class="form-control text-bg-secondary mb-2" name="password" placeholder="Password">
                            <input type="checkbox" onclick="showPassword()">  Show Password
                        </div>
                        <div class="text-end mt-2">
                            <a href="#">Forgot password?</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" value="Sign in" class="btn rounded-4 px-4 mt-3 mb-5" style="background-color:#EAE5FF; width:70%;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5 pt-5" style="margin-left:15px">
                <img src="{{asset('/img/login/login.gif')}}" alt="Registraction" width="400px" height="auto" class="rounded-3">
            </div>
        </div>
    </div>
</div>
</div>