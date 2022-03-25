@extends('layouts.app-admin')
@section('title', $title)
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('modules.index')}}">Modules</a></li>
            <li class="breadcrumb-item">Modifier module</li>

        </ol>
    </nav>
    <div class="container">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                        <form method="POST" action="{{ route('modules.update', $module->id ) }}">
                            @csrf
                                 <div class="card">
                                     <div class="card-body">
                                        <div class="form-group">
                                            <label for="nomModule">Module:</label>
                                            <input type="text" class="form-control" name="nomModule" value="{{ $module->nom_module }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="coeffModule">Coefficient:</label>
                                            <input type="text" class="form-control" name="coeffModule" value="{{ $module->coefficient_module }}"/>
                                        </div>

                                         <div class="form-group">
                                             <label for="">Niveau </label>
                                             <select class="form-control @error('niveau_id') is-invalid @enderror"  name="niveau_id">
                                                 <option value="{{$module->niveau_id}}" selected>  </option>
                                                 @foreach( $niveaux as $niv)
                                                     <option value="{{$niv->id}}" {{$niv->id == $module->niveau_id ? 'selected' : ''}} > {{$niv->level}} </option>
                                                 @endforeach

                                             </select>
                                         </div>


                                             <button type="submit" class="btn btn-primary">Valider</button>
                                      </div>
                                  </div>
                        </form>
                 </div>
             </div>
        </div>
    </div>
@endsection
