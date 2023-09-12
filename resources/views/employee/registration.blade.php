@extends('employee.layout')
@section('title','Registration Page')
@section('head')
<link rel="stylesheet" href="{{asset('css/registration.css')}}">
<script src="{{asset('js/registration.js')}}"></script>
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
                <h3>CREATE YOUR ACCOUNT</h3>
                <div class="relogin my-3">
                    <small>Already a member?  <a href="{{ route('login') }}">login</a></small>
                </div>
                <div class="form">
                    <form action="{{ route('store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" id="rname" value="{{old('name')}}" class="form-control text-bg-secondary mb-3 rounded-3" placeholder="Name" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="remail" value="{{old('email')}}" class="form-control text-bg-secondary mb-3 rounded-3" placeholder="Email" autocomplete="email">
                        </div>
                        <div class="form-group">
                            <input id="rpassword" type="password" class="form-control text-bg-secondary mb-2" name="password" value="{{old('password')}}" placeholder="Password">
                            <input type="checkbox" onclick="showPassword()">  Show Password
                        </div>
                        
                        <br>
                        <small style="font-size:12px;">By clicking on "sign up" you are agreeing with <a href="#">Terms & Condition</a></small>
                        <br>
                        <div class="d-flex justify-content-center">
                            <input type="submit" value="Sign up" class="btn rounded-4 px-4 mt-3 mb-5" style="background-color:#EAE5FF; width:70%;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5" style="margin-top: 10%;">
                <div class="card rounded-3">
                <img src="{{asset('/img/registraction/regestraction.webp')}}" alt="Registraction" width="400px" height="auto">
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>