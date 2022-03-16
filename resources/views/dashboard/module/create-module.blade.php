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
            Ajouter un module
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form method="post" action="{{ route('modules.storeModule') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="col">
                                        @csrf
                                        <label for="nomModule"> Module:</label>
                                        <input type="text" class="form-control" name="nomModule"/>

                                    </div>
                                    <div class="col">
                                        <label for="coeffModule">Coefficient </label>
                                        <input type="text" class="form-control" name="coeffModule"/>
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
