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

  <div class="card-body">
      <div class="row">
          <div class="col-md-4 offset-md-4">

              <form method="POST" action="{{ route('classes.update', $class->id ) }}">
              @csrf
                  <div class="card">
                      <div class="card-body">
                              <div class="form-group">
                                  <label for="name">Classroom:</label>
                                  <input type="text" class="form-control" name="name" value="{{ $class->name }}"/>
                              </div>

                              <div class="form-group">
                                  <label for="niveau">Niveau </label>
                                  <select class="form-control @error('niveau') is-invalid @enderror"  name="niveau">
                                      <option value="{{$class->id_level}}" selected>  </option>
                                      @foreach( $niveaux as $niv)
                                          <option value="{{$niv->id}}" {{$niv->id == $class->id_level ? 'selected' : ''}} > {{$niv->level}} </option>
                                      @endforeach

                                  </select>
                              </div>
                               <br>

                                <button type="submit" class="btn btn-outline-primary btnModif">Modifier</button>
                        </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection
