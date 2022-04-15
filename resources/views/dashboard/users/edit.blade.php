@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .editUser{
            margin-left: 13px;
        }

        .edit{
            margin-top: 23px;
            margin-left: 151px;
            width: 126px;
        }
        .customFile{
            font-size: 16px;
            background: white;
            border-radius: 50px;
            box-shadow: 5px 5px 10px black;
            width: 280px;
            outline: none;
        }
        ::-webkit-file-upload-button{
            color: white;
            background: #206a5d;
            padding: 9px;
            border: none;
            border-radius: 50px;
            box-shadow: 1px 0 1px #6b4559;
            outline: none;
        }
        ::-webkit-file-upload-button:hover{
            background: #438a5e;
        }
        .profilImg{
            width: 150px;
            height: 150px;
        }
        .image{
            border: 2px dashed #c2cdda;
            padding: 34px;
            margin-top: 47px;
            width: 53%;
            margin-left: 74px;

        }
        .profilImg{
            width: 144px;
            height: 150px;
            margin-left: -32px;
            border: none;
        }
        .profil{
            margin-top: 17px;
        }
        .btn{
            margin-left: 725%;
            margin-top: 25px;
            width: 120px;

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

            <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-7 editUser">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h5 class="card-title">User information</h5>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check col-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" @if($user->status=="Active") checked @endif   id="switch1" name="status">
                                                <label class="custom-control-label" for="switch1">Status</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <hr />
                                <div class="form-group">
                                    <label for="">Nom & Prénom</label>
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}" >
                                </div>
                                <div class="form-group">
                                    <label for="">Email </label>
                                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Saisir email" value="{{$user->email}}">
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="mb-3">
                                            <label for="">Mot de passe </label>
                                            <div class="input-group mb-3">
                                                      <span class="input-group-text" id="basic-addon1"
                                                      ><i class="fa fa-key"></i></span>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" aria-describedby="emailHelp" placeholder="">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <br><br>
                                        <a href="#" id="btn" onclick="passwordGenerator()">Génerer </a>
                                    </div>
                                    <!--/span-->

                                    <!--/span-->
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

                    <div class="col-4 profil">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Image de profil</h5>
                                <hr />
                                <div class="form-group">
                                    <div class="mb-3">
                                        <input type="file" name="image" class="customFile" id="image-input"  onchange="loadFile(event)" >
                                        <div class="image" ><img  src="{{asset('assets/'.$user->image)}}" id="output" class="profilImg" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-outline-info rounded-pill px-4">Enregistrer</button>

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

    <script>
        var loadFile= function(event){
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };

    </script>
@endsection
