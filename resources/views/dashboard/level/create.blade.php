@extends('layouts.app-admin')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
  <div class="card-header">
    Add level Data
  </div>
  <div class="card-body">
      <div class="row">
          <div class="col-sm-5 mx-auto">
              <form method="post" action="{{ route('levels.store') }}">
                  @csrf
                      <div class="card">
                          <div class="card-body">
                              <div class="col-md-12">
                                  <label for="level"> Level:</label>
                                  <input type="text" class="form-control @error('level') is-invalid @enderror" name="level"/>
                                  @error('level')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                               <br>

                                <button type="submit" class="btn btn-primary"> Ajouter </button>
                           </div>
                      </div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection
