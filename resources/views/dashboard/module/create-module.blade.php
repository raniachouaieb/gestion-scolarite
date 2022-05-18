@extends('layouts.app-admin')

@section('title', $title)
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('modules.index')}}">Modules</a></li>
                <li class="breadcrumb-item active" aria-current="page">création module</li>

            </ol>
        </nav>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form method="post" action="{{ route('modules.storeModule') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="col">
                                        @csrf
                                        <label for="nom_module"> Module:</label>
                                        <input type="text" class="form-control @error('nom_module') is-invalid @enderror" name="nom_module"/>
                                        @error('nom_module')
                                        <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                        @enderror

                                    </div>
                                    <div class="col">
                                        <label for="coefficient_module">Coefficient </label>
                                        <input type="text" class="form-control @error('coefficient_module') is-invalid @enderror" name="coefficient_module"/>
                                        @error('coefficient_module')
                                        <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">Niveau </label>
                                        <select class="form-control @error('niveau_id') is-invalid @enderror"  name="niveau_id">
                                            <option value="" selected> Affecter un niveau </option>
                                            @foreach( $niveaux as $niv)
                                                <option value="{{$niv->id}}" > {{$niv->level}} </option>
                                            @endforeach

                                        </select>
                                        @error('niveau_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <br>

                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
