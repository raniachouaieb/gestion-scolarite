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
    <div class="row">
        <div class="col-md-4 offset-md-4">
              <form method="post" action="{{ route('classes.store') }}">
              @csrf
                  <div class="card">
                     <div class="card-body">
                          <div class="form-group">
                              <div class="col">
                                    <label for="">Classe </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"/>
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror

                              </div>
                              <div class="col">
                                    <label for="">Niveau </label>
                                    <select class="form-control @error('id_level') is-invalid @enderror"  name="id_level">
                                                    <option value="" selected> Choisir </option>
                                                    @foreach( $niveaux as $niv)
                                                      <option value="{{$niv->id}}" > {{$niv->level}} </option>
                                                    @endforeach

                                    </select>
                                  @error('id_level')
                                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                              </div>

                           </div>


                            <button type="submit" class="btn btn-primary">Add Classroom</button>
                      </div>
                  </div>
              </form>
         </div>
    </div>
  </div>
</div>
@endsection

