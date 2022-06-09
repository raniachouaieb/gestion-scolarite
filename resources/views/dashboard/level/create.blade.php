@extends('layouts.app-admin')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('levels.index')}}">Niveaux</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajouter niveau</li>

        </ol>
    </nav>
    <div class="card page-body">
        <div class="card-body">
          <div class="col-sm-12 mx-auto">
              <form method="post" action="{{ route('levels.store') }}">
                  @csrf
                  <div class="row">
                      <div class="col-md-12">
                          <div class="headers-line mt-md" style="color: #ef6f6c;"><i class="fas fa-plus"></i> {{__(' nouveau niveau')}}</div>
                          <hr>
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="level"> Level:</label>
                                  <input type="text" class="form-control @error('level') is-invalid @enderror" name="level"/>
                                  @error('level')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>


                          </div>
                      </div>  </div>
                  <hr>
                  <div class="d-flex justify-content-between">
                      <span></span>
                      <button class="btn btn-primary" type="submit">{{ __('Ajouter')}}</button>
                  </div>
{{--                      <div class="card">--}}
{{--                          <div class="card-body">--}}
{{--                              <div class="col-md-12">--}}
{{--                                  <label for="level"> Level:</label>--}}
{{--                                  <input type="text" class="form-control @error('level') is-invalid @enderror" name="level"/>--}}
{{--                                  @error('level')--}}
{{--                                  <span class="invalid-feedback" role="alert">--}}
{{--                                      <strong>{{ $message }}</strong>--}}
{{--                                  </span>--}}
{{--                                  @enderror--}}
{{--                              </div>--}}
{{--                               <br>--}}

{{--                                <button type="submit" class="btn btn-primary"> Ajouter </button>--}}
{{--                           </div>--}}
{{--                      </div>--}}
              </form>
          </div>
      </div>
  </div>
</div>
@endsection
