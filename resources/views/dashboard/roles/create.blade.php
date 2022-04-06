@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('list')}}">Rôles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Créer un rôle</li>

            </ol>
        </nav>


        <div class="card-body">

            <form method="post" action="{{route('roles.store')}}">
                @csrf
                <div class="card shadow">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Rôle:</label>
                            <input type="text" class="form-control @error('role') is-invalid @enderror" name="role"  placeholder="">
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">Permission : </div>
                            @foreach($permission as $perm)

                                <div class="form-check col-md-12">
                                    <label>{{ Form::checkbox('permission[]', $perm->id, false, array('class' => 'name'))  }}
                                        {{ $perm->name }}</label>
                                    <br/>
                                </div>
                                @error('permission')
                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            @endforeach
                        </div>




                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
