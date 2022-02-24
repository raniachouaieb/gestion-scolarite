@extends('layouts.app-login-admin')

@section('content')
<div class="container">

                    <form method="POST" action="{{ route('admin.getLogin') }}">
                        @csrf

                        <div class="form-group">

                            
                            <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group">

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                                id="exampleInputPassword" placeholder="Password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label" for="customCheck">RememberMe</label>
                        </div>
                        </div>

                        
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Login') }}
                                </button>

                               
                           
                    </form>
                    <hr>
                                    <div class="text-center">
                                    @if (Route::has('password.request'))
                                        <a class="small" href="forgot-password.html">
                                        {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                
           
</div>
@endsection
