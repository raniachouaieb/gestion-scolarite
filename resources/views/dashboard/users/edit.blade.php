@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .editUser{
            margin-left: 39px;
            margin-top: 49px;
        }
        .passModif{
            margin-top: 131px;
            margin-left: 12px;

        }
        .edit{
            margin-top: 23px;
            margin-left: 151px;
            width: 126px;
        }

    </style>
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
                <div class="row">
                    <div class="col-md-6 editUser">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nom & Prénom</label>
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}" >
                                </div>
                                <div class="form-group">
                                    <label for="">Email </label>
                                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Saisir email" value="{{$user->email}}">
                                </div>


                                <div class="form-group">
                                    <label for="">Rôle</label>
                                    <select class="form-control  " id="" name="role">
                                        <option value="{{$user->roles_name}}" selected> </option>
                                        @foreach($roles as $rol)
                                        <option value="{{$rol->id}}" {{$rol->id == $user->roles_name ? 'selected' : ''}} >{{$rol->name}} </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-5 passModif">
                        <div class="card shadow">
                            <div class="card-body">
                                <label>Status</label>
                                <div class="row">
                                    <div class="form-check col-4 ml-5">
                                        <input class="form-check-input" type="radio" name="status" value="false" {{ $user->status == 0 ? 'checked' : ''}} id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Absent
                                        </label>
                                    </div>
                                    <div class="form-check col-4">
                                        <input class="form-check-input" type="radio" name="status" value="true" {{ $user->status == 1 ? 'checked' : ''}} id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Modifier mot de passe</label>
                                    <button type="submit" class="btn btn-info">Génerer mot de passe</button>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary edit">Submit</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
