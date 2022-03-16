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
            Edit Module Data
        </div>
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


                                             <button type="submit" class="btn btn-primary">Valider</button>
                                      </div>
                                  </div>
                        </form>
                 </div>
             </div>
        </div>
    </div>
@endsection
