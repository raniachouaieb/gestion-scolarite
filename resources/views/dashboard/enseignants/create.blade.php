@extends('layouts.app-admin')
@section('title', $title)
<style>
    .profilImg{
        width: 200px;
        height: 150px;
        margin-left: 35px;
        border: none;
    }
   .addEns{

   }
</style>
@section('content')
    <div class="container">
        @include('includes.alerts.flash')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('enseignants')}}">Liste des enseinants</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ajouter</li>

            </ol>
        </nav>

        <form method="post" action="{{route('enseignant.create')}}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title">User information</h5>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" checked id="switch1" name="status">
                                        <label class="custom-control-label" for="switch1">Status</label>
                                    </div>
                                </div>

                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="nom">Nom </label>
                                        <input type="text" class="form-control" name="nom" />
                                    </div>
                                </div>
                                <div class="col-4"><label for="" >prénom </label>
                                    <input type="text" class="form-control" name="prenom"  />
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                            <h5 class="card-title color"><i class="fa fa-info-circle"></i> Parcours académique</h5>
                            <hr />
                            <div class="mb-3">
                                <label for="adresse">Anné de diplôme </label>
                                <input type="date" class="form-control" name="annee_obt_diplome"  />
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="gender">gender </label>
                                        <select class="form-control" name="gender">
                                            <option value="" > Choisir </option>
                                            <option value="femme" > Femme </option>
                                            <option value="homme" > Homme </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="gender">l'état matrimonial </label>
                                    <select class="form-control" name="etat_matrimonial">
                                        <option value="" > Choisir </option>
                                        <option value="mariee" > Mariée </option>
                                        <option value="celibataire" > Célibatire </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">

                            <div class="mb-3">
                                <label for="email">Ans d'éperience </label>
                                <input type="number" class="form-control" name="ans_exp"  />
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label for="">Date de naissance </label>
                                        <input type="date" class="form-control" name="date_naiss">

                                    </div>
                                </div>
                                <div >

                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">

                            <div class="mb-3">
                                <label for="">Spécialité </label>
                                <input type="text" class="form-control" name="specilaite" />
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-3">

                                    </div>
                                </div>
                                <div >

                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">

                            <div class="mb-3">
                                <label for="">Date d'embauche </label>
                                <input type="date" class="form-control" name="date_embauche" />
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-title color"><i class="fa fa-info-circle"></i> Contact & Login</h5>
                            <hr />
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="nom">Télephone </label>
                                        <input type="phone" class="form-control" name="telephone" />
                                    </div>
                                </div>
                                <div class="col-4"><label for="" >Adresse </label>
                                    <input type="text" class="form-control" name="adresse"  />
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                     <div class="col-md-4">
                            <h5 class="card-title color"><i class="fa fa-image"></i> Affectation</h5>
                            <hr />
                         <div class="mb-3">
                             <label>Rôle</label>
                             <select class="form-control @error('role') is-invalid @enderror "   name="role">
                                 <option value="" selected>  </option>
                                 @foreach($roles as $rol)
                                     <option value="{{$rol->id}}" > {{$rol->name}} </option>
                                 @endforeach
                             </select>
                         </div>

                        <!--/span-->
                     </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-4">
                                    <label for="">Email </label>
                                    <div class="input-group mb-3">
                                                      <span class="input-group-text" id="basic-addon1"
                                                      ><i class="fa fa-mail-bulk"></i></span>
                                        <input type="email" class="form-control " name="email" aria-describedby="emailHelp" placeholder="">

                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="">Mot de passe </label>
                                    <a href="#" id="btn" onclick="passwordGenerator()" style="margin-left: 53px">Génerer </a>

                                    <div class="input-group mb-3">
                                                      <span class="input-group-text" id="basic-addon1"
                                                      ><i class="fa fa-key"></i></span>
                                        <input type="password" class="form-control " name="password" id="password" aria-describedby="emailHelp" placeholder="">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Niveau</label>
                                    <select class="form-control"   id="niveau" name="niveau">
                                        <option value="" selected>  </option>
                                        @foreach($niveaux as $niv)
                                            <option value="{{$niv->id}}" > {{$niv->level}} </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-4">

                                </div>
                                <div class="col-4">


                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Module</label>
                                <select class="form-control" id="modul"  name="modul">
                                    <option value="" selected>  </option>
                                        <option value="" >  </option>
                                </select>
                            </div>
                        </div>
                        <!--/span-->
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title color"><i class="fa fa-image"></i> Image de profil</h5>
                            <hr />
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <div class="image" ><img  src="{{asset('assets/uploads/parents/placeholderImage.png')}}" onclick="clickImage()" id="profileDisplay" class="profilImg" ></div>

                                        <label>Choisir une photo</label>
                                        <input type="file" name="image_profile" id="imageProfile" onchange="loadFile(event)" style="display: none;">

                                    </div>
                                </div>
                                <div class="col-4">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">

                        </div>
                        <!--/span-->
                    </div>


                </div>
                <button type="submit" class="btn btn-outline-info btn-circle right addEns" style=" margin-left: 925px; width: 141px;margin-bottom: 10px;"><i class="fas fa-check"></i> Ajouter</button>

            </div>



        </form>
    </div>
    <script>
        function clickImage(){
            document.querySelector('#imageProfile').click();
        }
        var loadFile = function(event){
            var profileDisplay = document.getElementById('profileDisplay');
            profileDisplay.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
        $(document).ready(function(){
            $("#niveau").change(function(){
                $value=$(this).val(),
                    console.log($value);
                $('#modul').empty();
                $('#modul').append('<option value="">--- choisir ---</option>')
                $.ajax({
                    url: "{{ url('admin/enseignants/getModule') }}",
                    data:{"niveau":$value,},
                    method: 'GET',
                    success: function(data) {
                        var count=0;
                        $.each(data,function(k,v){
                            $('#modul').append($('<option>',{value: k, text: v}));
                            count++;
                        });
                        if(count==0){
                            $('#modul').empty();
                            $('#modul').append('<option value="">Aucun module disponible</option>')
                        }
                    },
                    error:function(data){
                        $('#modul').append('<option value="">Aucun module affecter</option>')
                    }
                });
            });
        });
    </script>

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
