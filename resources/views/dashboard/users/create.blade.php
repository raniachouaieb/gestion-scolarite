@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admins')}}">Utilisateurs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Créer un utilisateur</li>

        </ol>
    </nav>


    <div class="card-body">

        <form method="post" action="{{ route('users.storeUser') }}">
            @csrf
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nom & Prénom</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Saisir votre nom et prénom">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                        @enderror
                    </div>
                    <div class="form-group">
                    <label for="">Email </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" aria-describedby="emailHelp" placeholder="Saisir email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                        @enderror
                    </div>
                <div class="form-group">
                    <label for="">Mot de passe</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mot de passe">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                    @enderror
                </div>
                    <div class="form-group">
                        <label for="">Confirmer mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mot de passe">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Rôle</label>
                        <select class="form-control @error('role') is-invalid @enderror "   name="role">
                            <option value="" selected>  </option>
                            @foreach($roles as $rol)
                            <option value="{{$rol->id}}" > {{$rol->name}} </option>
                            @endforeach

                        </select>

                    </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
            </div>
    </form>
    </div>
</div>
@endsection
