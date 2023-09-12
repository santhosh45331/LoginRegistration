@extends('employee.layout')
@section('title','Home Page')
@section('content')
<nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                    <li class="nav-item card p-3 text-uppercase">{{ Auth::user()->name }}</li>
                    <li class="nav-item text-uppercase ms-3">
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                        <button type="submit" class="btn btn-outline-danger mt-3">Logout</button>
                    </form>
                </li>
            </ul>
          </div>
        </div>
    </nav>
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Home</div>
            <div class="card-body">
                @if ($message = Session::get('Success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>       
                @endif                
            </div>
        </div>
    </div>    
</div>