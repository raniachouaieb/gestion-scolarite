@extends('layouts.app-admin')
@section('title', $title)
@section('content')
<style>
  .btnModif {
      margin-left: 90px;
  }
</style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('classes.index')}}">Classes</a></li>
        <li class="breadcrumb-item">Modifier groupe</li>

    </ol>
</nav>
<div class="container">

    <div class="card page-body">
        <div class="card-body">

              <form method="POST" action="{{ route('classes.update', $class->id ) }}">
              @csrf
                  <div class="row">
                      <div class="col-md-12">
                          <div class="headers-line mt-md" style="color: #ef6f6c;"><i class="fas fa-plus"></i> {{__(' Modification classe')}}</div>
                          <hr>
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="name">Classroom:</label>
                                  <input type="text" class="form-control" name="name" value="{{ $class->name }}"/>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="niveau">Niveau </label>
                                  <select class="form-control @error('niveau') is-invalid @enderror"  name="niveau">
                                      <option value="{{$class->id_level}}" selected>  </option>
                                      @foreach( $niveaux as $niv)
                                          <option value="{{$niv->id}}" {{$niv->id == $class->id_level ? 'selected' : ''}} > {{$niv->level}} </option>
                                      @endforeach

                                  </select>
                              </div>

                          </div>
                      </div>  </div>
                  <hr>
                  <div class="d-flex justify-content-between">
                      <span></span>
                      <button class="btn btn-primary" type="submit">{{ __('Modifier')}}</button>
                  </div>
              </form>
      </div>
  </div>
</div>
@endsection
