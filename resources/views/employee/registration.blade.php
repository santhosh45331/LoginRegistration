@extends('employee.layout')
@section('title','Registration Page')
@section('head')
<link rel="stylesheet" href="{{asset('css/registration.css')}}">
<script src="{{asset('js/registration.js')}}"></script>
@section('content')
<div class="container rounded-3 py-5" style="background-color:#EAE5FF; margin-top:30px;">
<div class="row  d-flex justify-content-center">
    <div class="col-md-9 text-bg-dark rounded-3">
        <div class="row">
            <div class="col-md-6" style="padding:0px 80px 0px 80px;">
                <div class="brand-name mb-md-5 mt-2">
                <i class="fa-solid fa-face-smile" style="color: #ffffff;"></i>
                <small>Employee</small>
                </div>
                <div class="sub-text">
                    <span>Be part of this movement.</span>
                    <hr>
                </div>
                <h3>CREATE YOUR ACCOUNT</h3>
                <div class="relogin my-3">
                    <small>Already a member?  <a href="/login">login</a></small>
                </div>
                <div class="form">
                    <form action="{{ route('store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" id="rname" value="{{old('name')}}" class="form-control @error('name') text-bg-secondary mb-3 rounded-3" placeholder="Name" autofocus>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="remail" value="{{old('email')}}" class="form-control text-bg-secondary mb-3 rounded-3" placeholder="Email" autocomplete="email">
                        </div>
                        <div class="form-group">
                            <input id="rpassword" type="password" class="form-control text-bg-secondary" name="password" value="{{old('email')}}" placeholder="Password">
                            <span toggle="#rpassword" class="fa-regular fa-eye field-icon toggle-password"  style="color: #ffffff;"></span>
                        </div>
                        <small style="font-size:10px;">Password must contain 8 or more characters</small>
                        <br>
                        <small style="font-size:12px;">By clicking on "sign up" you are agreeing with <a href="#">Terms & Condition</a></small>
                        <br>
                        <div class="d-flex justify-content-center">
                            <input type="submit" value="Sign up" class="btn rounded-4 px-4 mt-3 mb-5" style="background-color:#EAE5FF; width:70%;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5 pt-5">
                <img src="{{asset('/img/registraction/regestractionimg.jpg')}}" alt="Registraction" width="400px" height="450px" class="rounded-3">
            </div>
        </div>
    </div>
</div>
</div>