@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admins')}}">Utilisateurs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mettre à jour un utilisateur</li>

            </ol>
        </nav>


        <div class="card-body">

            <form method="post" action="{{ route('users.update', $user->id) }}">
                @csrf
                <div class="card shadow">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nom & Prénom</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}" >
                        </div>
                        <div class="form-group">
                            <label for="">Email </label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Saisir email" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="">Mot de passe</label>
                            <input type="password" class="form-control" id="password" placeholder="Mot de passe" value="{{$user->password}}">
                        </div>
                        <div class="form-group">
                            <label for="">Confirmer mot de passe</label>
                            <input type="password" class="form-control" id="password" placeholder="Mot de passe" value="{{$user->password}}">
                        </div>

                        <div class="form-group">
                            <label for="">Rôle</label>
                            <select class="form-control  " id="" name="">
                                <option value="" selected> </option>
                                <option value="" > </option>
                            </select>

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
