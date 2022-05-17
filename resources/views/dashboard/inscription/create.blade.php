@extends('layouts.app-admin')
@section('title', $title)
@section('content')
    <style>
        .addParent{


            margin-left: 192px;
            /* width: 121px; */
            margin-top: -24px;
            position: absolute;
            width: 38%;

        }
        .modifElev{
            width: 121px;
            margin-left: 872px;

        }
        .color{
            color: #1d68a7;
        }
        #profileDisplay{
            display: block;
            width: 60%;
            margin: 10px auto;
            border-radius: 50%;


        }
    </style>

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ajouter Parent</li>

            </ol>
        </nav>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12">
                <div class="card material-card">
                    <div class="card-body">

                        <form method="post" action="{{route('store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="card-title color"><i class="fa fa-info-circle"></i> Informations personnelles</h5>
                                            <hr />
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3">
                                                        <label for="nomPere">Nom  Père</label>
                                                        <input type="text" class="form-control  @error('nomPere') is-invalid @enderror" name="nomPere" value="{{old('nomPere')}}" />
                                                        @error('nomPere')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4"><label for="" >Nom  Mère</label>
                                                    <input type="text" class="form-control @error('nomMere') is-invalid @enderror" name="nomMere"  value="{{old('nomMere')}}" />
                                                    @error('nomMere')
                                                    <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <h5 class="card-title color"><i class="fa fa-info-circle"></i> Information communes</h5>
                                            <hr />
                                            <div class="mb-3">
                                                <label for="adresse">Adresse </label>
                                                <input type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{old('adresse')}}" />
                                                @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3">
                                                        <label for="nomPere">Prénom Père</label>
                                                        <input type="text" class="form-control @error('prenomPere') is-invalid @enderror" name="prenomPere"  value="{{old('prenomPere')}}" />
                                                        @error('prenomPere')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4"><label for="" >Prénom Mère</label>
                                                    <input type="text" class="form-control @error('prenomMere') is-invalid @enderror" name="prenomMere"  value="{{old('prenomMere')}}" />
                                                    @error('prenomMere')
                                                    <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">

                                            <div class="mb-3">
                                                <label for="email">Email </label>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" />
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3">
                                                        <label for="nomPere">Professio Père</label>
                                                        <input type="text" class="form-control @error('professionPere') is-invalid @enderror" name="professionPere" value="{{old('professionPere')}}"  />
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4"><label for="" >Profession Mère</label>
                                                    <input type="text" class="form-control @error('professionMere') is-invalid @enderror" name="professionMere" value="{{old('professionMere')}}"  />
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">

                                            <div class="mb-3">
                                                <label for="nbEnfants">Mot de passe</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" />
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-3">
                                                        <label for="">Téléphone Père</label>
                                                        <input type="text" class="form-control @error('telPere') is-invalid @enderror" name="telPere" value="{{old('telPere')}}"  />
                                                        @error('telPere')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4"><label for="" >Téléphone Mère</label>
                                                    <input type="text" class="form-control @error('telMere') is-invalid @enderror" name="telMere"  value="{{old('telMere')}}"/>
                                                    @error('telMere')
                                                    <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">

                                            <div class="mb-3">
                                                <label for="nbEnfants">Nombre enfants</label>
                                                <input type="text" class="form-control @error('nbEnfants') is-invalid @enderror" name="nbEnfants" value="{{old('nbEnfants')}}" />
                                                @error('nbEnfants')
                                                <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
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

                                                            <img src="{{asset('assets/uploads/parents/placeholderImage.png')}}"  onclick="clickImage()" id="profileDisplay" alt="fgh"/>

                                                        <label>Choisir une photo</label>
                                                        <input type="file" name="image_profile" id="imageProfile" onchange="loadFile(event)" style="display: none;" value="{{old('image_profile')}}">
                                                        @error('image_profile')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

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
                            </div>
                            <div class="card mt-5 " id="info-eleve">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="card-title color"><i class="fa fa-info-circle"></i> Information Enfant(s)</h5>
                                            <hr />
                                            <div class="field[1]" data-groupe="eleve">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="mb-3">
                                                            <label for="">Nom  </label>
                                                            <input type="text" class="form-control" name="nomEleve" value="{{old('nomEleve')}}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-4"><label for="" >Prénom  </label>
                                                        <input type="text" class="form-control" name="prenomEleve" value="{{old('prenomEleve')}}"  />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="mb-3">
                                                            <label for="">Gender</label>
                                                            <select  id="month" name="gender" class="form-control @error('gender') is-invalid @enderror list-dt" value="{{old('gender')}}"  >
                                                                <option selected>Gender</option>
                                                                <option value="garcon" > Garcon </option>
                                                                <option value="fille" > Fille </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="" >Niveau</label>
                                                        <select id="niv" name="niveau" class="form-control @error('niveau') is-invalid @enderror list-dt" value="{{old('niveau')}}">
                                                            <option value="" selected> Niveau </option>
                                                            @foreach($niveaux as $niv)
                                                                <option value="{{$niv->id}}" > {{$niv->level}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('niveau')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                         </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-8">
                                                        <label>Date naissance</label>
                                                        <input type="date" name="birth" placeholder="Date naissance" class="form-control @error('birth') is-invalid @enderror" value="{{old('birth')}}"/>
                                                        @error('birth')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="col-md-4 col-md-offset-8">
                                    <a id="add-more"  class="btn btn-success" onclick="add_more_enfant()" style="color: white;">Ajouter enfant +</a>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-outline-info btn-circle right addParent"><i class="fas fa-check"></i> Ajouter</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">


        </div>

    </div>

    <script>
        $(document).ready(function(){
            $("#niveau").change(function(){
                $value=$(this).val(),
                    console.log($value);
                $('#classe').empty();
                $('#classe').append('<option value="">--- choisir ---</option>')
                $.ajax({
                    url: "{{ url('admin/inscri/getClasse') }}",
                    data:{"niveau":$value,},
                    method: 'GET',
                    success: function(data) {
                        var count=0;
                        $.each(data,function(k,v){
                            $('#classe').append($('<option>',{value: k, text: v}));
                            count++;
                        });
                        if(count==0){
                            $('#classe').empty();
                            $('#classe').append('<option value="">Aucun Classe disponible</option>')
                        }
                    },
                    error:function(data){
                        $('#classe').append('<option value="">Aucun classse affecter</option>')
                    }
                });
            });
        });
    </script>
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
        var counter=1;
        function add_more_enfant(){


            //var infoEleve = document.getElementById('info-eleve');

            counter+=1;

            $('#info-eleve').append( '<div class="field['+counter+']">'+
                '<div class="row">'+
               '<div class="col-4">'+
                '<div class="mb-3">'+
                '<label for="">Nom  </label>'+
                '<input type="text" class="form-control" name="nomEleve['+counter+']"  />'+
        '</div>'+
        '</div>'+
            '<div class="col-4"><label for="" >Prénom  </label>'+
                '<input type="text" class="form-control" name="prenomEleve['+counter+']"   />'+
           '</div>'+
                '<div class="col-4">'+

                ' <a  type="button" id="remove" name="remove" value="remove" class="btn btn-danger" style="color: white;">-</a>'+
                '</div>'+
        '</div>'+

           ' <div class="row">'+
                '<div class="col-4">'+
                    '<div class="mb-3">'+
                        '<label for="">Gender</label>'+
                        '<select  id="month" name="gender['+counter+']" class="form-control @error('gender') is-invalid @enderror list-dt"  >'+
                            'option selected>Gender</option>'+
                           ' <option value="garcon" > Garcon </option>'+
                           ' <option value="fille" > Fille </option>'+
                        '</select>'+
                   ' </div>'+
                '</div>'+
                '<div class="col-4">'+
                    '<label for="" >Niveau</label>'+
                    '<select id="niv" name="niveau['+counter+']" class="form-control @error('niveau') is-invalid @enderror list-dt">'+
                       '<option value="" selected> Niveau </option>'+
                       '@foreach($niveaux as $niv)'+
                        '<option value="{{$niv->id}}" > {{$niv->level}}</option>'+
                        '@endforeach'+
                    '</select>'+
                    '@error('niveau')'+
                                                      '<span class="invalid-feedback" role="alert">'+
                                                           '<strong>{{ $message }}</strong>'+
                                                         '</span>'+
                    '@enderror'+
               ' </div>'+
            '</div>'+
            '<div class="row">'+

                '<div class="col-8">'+
                    '<label>Date naissance</label>'+
                    '<input type="date" name="birth['+counter+']" placeholder="Date naissance" class="form-control @error('birth') is-invalid @enderror" />'+
                    '@error('birth')'+
                                                       ' <span class="invalid-feedback" role="alert">'+
                                                           ' <strong>{{ $message }}</strong>'+
                                                       ' </span>'+
                    '@enderror'+
                '</div>'+
           '</div>'+
        '</div>');



        }


        $("#info-eleve").on("click", "#remove", function(){


        $(this).parent('<div class="field'+counter+'">'+
            '<div class="row">'+
            '<div class="col-4">'+
            '<div class="mb-3">'+
            '<label for="">Nom  </label>'+
            '<input type="text" class="form-control" name="nomEleve'+counter+'"  />'+
            '</div>'+
            '</div>'+
            '<div class="col-4"><label for="" >Prénom  </label>'+
            '<input type="text" class="form-control" name="prenomEleve'+counter+'"   />'+
            '</div>'+
            '</div>'+
            ' <div class="row">'+
            '<div class="col-4">'+
            '<div class="mb-3">'+
            '<label for="">Gender</label>'+
            '<select  id="month" name="gender'+counter+'" class="form-control @error('gender') is-invalid @enderror list-dt"  >'+
            'option selected>Gender</option>'+
            ' <option value="garcon" > Garcon </option>'+
            ' <option value="fille" > Fille </option>'+
            '</select>'+
            ' </div>'+
            '</div>'+
            '<div class="col-4">'+
            '<label for="" >Niveau</label>'+
            '<select id="niv" name="niveau'+counter+'" class="form-control @error('niveau') is-invalid @enderror list-dt">'+
            '<option value="" selected> Niveau </option>'+
            '@foreach($niveaux as $niv)'+
            '<option value="{{$niv->id}}" > {{$niv->level}}</option>'+
            '@endforeach'+
            '</select>'+
            '@error('niveau')'+
            '<span class="invalid-feedback" role="alert">'+
            '<strong>{{ $message }}</strong>'+
            '</span>'+
            '@enderror'+
            ' </div>'+
            '</div>'+
            '<div class="row">'+

            '<div class="col-8">'+
            '<label>Date naissance</label>'+
            '<input type="date" name="birth'+counter+'" placeholder="Date naissance" class="form-control @error('birth') is-invalid @enderror" />'+
            '@error('birth')'+
            ' <span class="invalid-feedback" role="alert">'+
            ' <strong>{{ $message }}</strong>'+
            ' </span>'+
            '@enderror'+
            '</div>'+
            '</div>'+
            '</div>').remove();
        counter--;


        })
    </script>


@endsection
