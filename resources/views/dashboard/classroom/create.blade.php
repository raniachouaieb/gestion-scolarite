@extends('layouts.app-admin')
@section('title', $title)

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="containerr">
  <div class="card-header">
    Add class Data
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('classes.store') }}">
      @csrf
      <div class="row mb-3">              
              <div class="col">
                    <label for="nomPere">Classe </label>
                      <input type="text" class="form-control" name="name"/>

                    </div>
                    <div class="col">
                    <label for="niveau">Niveau </label>
                    <select class="form-control @error('niveau') is-invalid @enderror"  name="niveau">
                                    <option value="" selected> Choisir </option>
                                    @foreach( $niveaux as $niv)
                                      <option value="{{$niv->id}}" > {{$niv->level}} </option>
                                    @endforeach
                                  
                    </select>  
                    </div>
              
          </div>
     
          
          <button type="submit" class="btn btn-primary">Add Classroom</button>
      </form>
  </div>
</div>
@endsection

