@extends('layouts.app-login-admin')

@section('content')

<div class="container">
    <!--@include('includes.alerts.flash')-->
    <div class="row align-items-center justify-content-center">
        <div class="col-md-6">
            <div class="form-block">
                <div class="text-center mb-5">
                    <h3>Login to <strong>Your dashboard</strong></h3>
                    <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
                </div>
                <form method="post" action="{{ route('admin.getLogin') }}">
                    @csrf
                    <div class="form-group first">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group last mb-3">
                        <label for="password">Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="d-sm-flex mb-5 align-items-center">
                        <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                            <input type="checkbox" checked="checked" />
                            <div class="control__indicator"></div>
                        </label>
                        <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                    </div>

                    <input type="submit" value="Log In" class="btn btn-block btn-primary">

                </form>
            </div>
        </div>
    </div>
</div>

@endsection