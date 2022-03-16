@extends('layouts.app-admin')

@section('title', $title)
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="container">
        <div class="card-header">
            Ajouter une matière
        </div>
        <div class="card-body">

                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form method="post" action="{{ route('matieres.storeMatiere') }}">
                            <div class="card">
                                <div class="card-body">
                                   <div class="form-group">
                                        <div class="col">
                                            @csrf
                                            <label for="nom"> Nom Matière:</label>
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"/>
                                            @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="coeff">Coefficient </label>
                                            <input type="text" class="form-control @error('coeff') is-invalid @enderror" name="coeff"/>
                                            @error('coeff')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                       <div class="col">
                                           <label for="module">Module </label>
                                           <select class="form-control @error('module') is-invalid @enderror"  name="module">
                                               <option value="" selected> Choisir module </option>
                                               @foreach( $modules as $modul)
                                                   <option value="{{$modul->id}}" > {{$modul->nom_module}} </option>
                                               @endforeach

                                           </select>
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
