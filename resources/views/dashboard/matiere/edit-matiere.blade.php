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
            Edit Matiere Data
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                        <form method="POST" action="{{ route('matieres.update', $matiere->id ) }}">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">

                                        <label for="nom">Matiere:</label>
                                        <input type="text" class="form-control" name="nom" value="{{ $matiere->nom }}"/>
                                    </div>
                                    <div class="form-group">

                                        <label for="coeff">Coefficient:</label>
                                        <input type="text" class="form-control" name="coeff" value="{{ $matiere->coefficient }}"/>
                                    </div>
                                    <div class="col">
                                        <label for="module">Module </label>
                                        <select class="form-control @error('module') is-invalid @enderror"  name="module">
                                            <option value="{{$matiere->module_id}}" selected>  </option>
                                            @foreach($modules as $modul)

                                                <option value="{{$modul->id}}" {{$modul->id == $matiere->module_id ? 'selected' : ''}} >
                                                    {{$modul->nom_module}}
                                                </option>
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
