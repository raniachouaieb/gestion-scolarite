@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .status{margin-left: 80px;
            margin-top: 103px;}
        .user{
            margin-left: 56px;
        }
        .add{
            margin-left: 839px;
            margin-top: -65px;
            width: 116px;
        }
    </style>
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
                <button type="submit" class="btn btn-primary add">Ajouter</button>

                <div class="row">
                    <div class="col-md-7 user">
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
                                <div class="row">
                                    <div class="col-8">
                                    <label for="">Mot de passe </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" aria-describedby="emailHelp" placeholder="">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                    @enderror
                                    </div>
                                    <div class="col-4">
                                        <br>
                                    <a href="#" id="btn" onclick="passwordGenerator()">Génerer </a>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <label for="">Rôle</label>
                                    <select class="form-control @error('role') is-invalid @enderror "   name="role">
                                        <option value="" selected>  </option>
                                        @foreach($roles as $rol)
                                            <option value="{{$rol->id}}" > {{$rol->name}} </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                    @enderror
                                </div>



                            </div>

                        </div>

                    </div>
                    <div class="col-3 status">
                        <div class="card shadow">
                            <div class="card-body">
                                <label>Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" checked id="switch1" name="status">
                                    <label class="custom-control-label" for="switch1">Status</label>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>

        function passwordGenerator(){
            var key_value= "1234567890!@#$%^&*()qwertyuiplmkjnhbgvfcxdsazQWERTYUIOPLKJHGFDSAZXCVBMN<,>.?//.[]{}|"
            var pass_size= 10;
            var create_pass = "";
            for(var i=0; i<pass_size; i++){
                var generate_random_number = Math.floor(Math.random() * key_value.length);
                create_pass += key_value.substring(generate_random_number, generate_random_number + 1);
            }
            document.getElementById("password").value= create_pass;
        }


    </script>
@endsection
