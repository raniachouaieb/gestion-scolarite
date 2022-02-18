@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!--<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>-->
                      <div class="input-group">
                          <div>
                              <p>Information Pere</p>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom Pere') }}</label>

                            <div class="col-md-6">
                                <input id="nomPere" type="text" class="form-control @error('nomPere') is-invalid @enderror" name="nomPere" value="{{ old('nomPere') }}" required autocomplete="nomPere" autofocus>

                                @error('nomPere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prenomPere" class="col-md-4 col-form-label text-md-right">{{ __('Prenom Pere') }}</label>

                            <div class="col-md-6">
                                <input id="prenomPere" type="text" class="form-control @error('prenomPere') is-invalid @enderror" name="prenomPere" value="{{ old('prenomPere') }}" required autocomplete="prenomPere" autofocus>

                                @error('prenomPere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                     

                        <div class="form-group row">
                            <label for="telPere" class="col-md-4 col-form-label text-md-right">{{ __('Telephone Pere') }}</label>

                            <div class="col-md-6">
                                <input id="telPere" type="text" class="form-control @error('telPere') is-invalid @enderror" name="telPere" value="{{ old('telPere') }}" required autocomplete="telPere" autofocus>

                                @error('telPere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="professionPere" class="col-md-4 col-form-label text-md-right">{{ __('Profession Pere') }}</label>

                            <div class="col-md-6">
                                <input id="professionPere" type="text" class="form-control @error('professionPere') is-invalid @enderror" name="professionPere" value="{{ old('professionPere') }}" required autocomplete="professionPere" autofocus>

                                @error('professionPere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                          </div>
                          <div>
                          <p>Information Mere</p>

                        <div class="form-group row">
                            <label for="nomMere" class="col-md-4 col-form-label text-md-right">{{ __('Nom Mere') }}</label>

                            <div class="col-md-6">
                                <input id="nomMere" type="text" class="form-control @error('nomMere') is-invalid @enderror" name="nomMere" value="{{ old('nomMere') }}" required autocomplete="nomMere" autofocus>

                                @error('nomMere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prenomMere" class="col-md-4 col-form-label text-md-right">{{ __('Prenom Mere') }}</label>

                            <div class="col-md-6">
                                <input id="prenomMere" type="text" class="form-control @error('prenomMere') is-invalid @enderror" name="prenomMere" value="{{ old('prenomMere') }}" required autocomplete="prenomMere" autofocus>

                                @error('prenomMere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telMere" class="col-md-4 col-form-label text-md-right">{{ __('Telephone Mere') }}</label>

                            <div class="col-md-6">
                                <input id="telMere" type="text" class="form-control @error('telMere') is-invalid @enderror" name="telMere" value="{{ old('telMere') }}" required autocomplete="telMere" autofocus>

                                @error('telMere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="professionMere" class="col-md-4 col-form-label text-md-right">{{ __('Profession Mere') }}</label>

                            <div class="col-md-6">
                                <input id="professionMere" type="text" class="form-control @error('professionMere') is-invalid @enderror" name="professionMere" value="{{ old('professionMere') }}" required autocomplete="professionMere" autofocus>

                                @error('professionMere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </div>
                        </div>

                        <div class="form-group row">
                            <label for="nbEnfants" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Enfants') }}</label>

                            <div class="col-md-6">
                                <input id="nbEnfants" type="number" class="form-control @error('nbEnfants') is-invalid @enderror" name="nbEnfants" value="{{ old('nbEnfants') }}" required autocomplete="nbEnfants" autofocus>

                                @error('nbEnfants')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-8">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Suivant') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
