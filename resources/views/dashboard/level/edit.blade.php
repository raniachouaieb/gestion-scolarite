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
            <li class="breadcrumb-item active" aria-current="page">Modifier niveau</li>

        </ol>
    </nav>
  <div class="card-body">
   @include('includes.alerts.flash')
      <div class="card-body">
          <div class="row">
              <div class="col-sm-5 mx-auto">
                  <form method="post" action="{{ route('levels.update', $level->id ) }}">
                          @csrf
                          <div class="card">
                              <div class="card-body">
                                  <div class="col-md-12">

                          <label for="level">Level:</label>
                          <input type="text" class="form-control" name="level" value="{{ $level->level }}"/>
                                  </div>
                              </div>
                          </div>
                      <br>

                        <button type="submit" class="btn btn-primary">Modifier</button>
                  </form>
              </div>
          </div>
      </div>

  </div>
</div>
@endsection
