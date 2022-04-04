@extends('layouts.app-admin')

@section('content')
    <style>

    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('permissions')}}">Permissions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Créer permission</li>

            </ol>
        </nav>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5 mx-auto">
                    <form method="post" action="{{route('permissions.store')}}">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <label for=""> Permission:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"/>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                    @enderror
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary"> Créer </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
