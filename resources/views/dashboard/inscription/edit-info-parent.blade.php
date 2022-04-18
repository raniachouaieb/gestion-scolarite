@extends('layouts.app-admin')
@section('title', $title)
@section('content')
    <style>
        .modifInfo{

            margin-left: 889px;
            width: 121px;
            margin-top: 11px;

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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Détaille</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modifier Information</li>

            </ol>
        </nav>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12">
                <div class="card material-card">
                    <div class="card-body">

    <form method="post" action="{{ route('inscri.update', $parent->id ) }}" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="nomPere" value="{{ $parent->nomPere }} " />
                                </div>
                            </div>
                            <div class="col-4"><label for="" >Nom  Mère</label>
                                <input type="text" class="form-control" name="nomMere" value="{{ $parent->nomMere }} " />
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-4">
                        <h5 class="card-title color"><i class="fa fa-info-circle"></i> Information communes</h5>
                        <hr />
                        <div class="mb-3">
                            <label for="adresse">Adresse </label>
                            <input type="text" class="form-control" name="adresse" value="{{ $parent->adresse }}" />
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
                                    <input type="text" class="form-control" name="prenomPere" value="{{ $parent->prenomPere }}" />
                                </div>
                            </div>
                            <div class="col-4"><label for="" >Prénom Mère</label>
                                <input type="text" class="form-control" name="prenomMere" value="{{ $parent->prenomMere }}" />
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-4">

                        <div class="mb-3">
                            <label for="email">Email </label>
                            <input type="text" class="form-control" name="email" value="{{ $parent->email }}" />
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
                                    <input type="text" class="form-control" name="professionPere" value="{{ $parent->professionPere }}" />
                                </div>
                            </div>
                            <div class="col-4"><label for="" >Profession Mère</label>
                                <input type="text" class="form-control" name="professionMere" value="{{ $parent->professionMere }}" />
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-4">

                        <div class="mb-3">
                            <label for="nbEnfants">Nombre Enfants </label>
                            <input type="number" class="form-control" name="nbEnfants" value="{{ $parent->nbEnfants }}" />
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
                                    <input type="text" class="form-control" name="telPere" value="{{ $parent->telPere }}" />
                                </div>
                            </div>
                            <div class="col-4"><label for="" >Téléphone Mère</label>
                                <input type="text" class="form-control" name="telMere" value="{{ $parent->telMere }}" />
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-4">

                        <div class="mb-3">
                            <label for="status"> Status</label>
                            <select class="form-control" name="status" selected>
                                <option value="{{$parent->is_active}}" >
                                    En attente</option>
                                <option value="accepter"  {{$parent->is_active ? 'selected' : ''}}>
                                    Accepter</option>
                                <option value="rejeter" >
                                    Refuser</option>
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
                                    @if($parent->image_profile)
                                        <img src="{{asset('assets/'.$parent->image_profile)}}"  onclick="clickImage()" id="profileDisplay" alt="fgh"/>
                                    @else
                                        <img src="{{asset('assets/uploads/parents/placeholderImage.png')}}"  onclick="clickImage()" id="profileDisplay" alt="fgh"/>

                                    @endif
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
         </div>

        <button type="submit" class="btn btn-outline-info btn-circle right modifInfo"><i class="fas fa-check"></i> Modifier</button>


    </form>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-title color"><i class="fa fa-info-circle"></i>Informations Enfants</h5>
                            <div class="tab-container-one">
                                <ul class="nav nav-tabs">
                                    @foreach($parent->students as $index=>$elev)
                                        <li class="nav-item @if($index==0) active @endif">
                                            <a class="nav-link @if($index==0) active @endif" href="#home{{$index}}" data-toggle="tab"
                                               aria-controls="home{{$index}}">Elève{{$index}}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">

                                    @foreach($parent->students as $index=>$elev)

                                        <div role="tabpanel" class="tab-pane @if($index==0) active @endif" id="home{{$index}}"
                                             aria-labelledby="home-tab{{$index}}">

                                            <form method="post" action="{{ route('inscri.updateEleve', $elev->id ) }}">
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="nomEleve">Nom </label>
                                                        <input type="text" class="form-control" name="nomEleve"
                                                               value="{{ $elev->nomEleve }}" />
                                                    </div>

                                                    <div class="col">
                                                        <label for="prenomEleve">Prénom </label>
                                                        <input type="text" class="form-control" name="prenomEleve"
                                                               value="{{ $elev->prenomEleve }}" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label for="gender">gender </label>
                                                        <select class="form-control" name="gender">
                                                            <option value="{{ $elev->gender }}" selected>
                                                                {{ $elev->gender==0 ? 'Garcon' : 'Fille' }}</option>

                                                            <option value="garcon"> Garçon </option>
                                                            <option value="fille"> Fille </option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <label for="niveau">niveau </label>

                                                        <select class="form-control" id="niveau" name="niveau">
                                                            <option value="{{$elev->niveau}} " selected> {{$elev->niveau}} </option>
                                                            @foreach( $levels as $lev)
                                                                <option value="{{$lev->id}}"
                                                                    {{$lev->id == $elev->niveau ? 'selected' : ''}}> {{$lev->level}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <label for="classe">classe </label>

                                                    <select class="form-control" id="classe" name="classe" >
                                                        <option value="" selected> {{$elev->class_id}} </option>

                                                        @foreach( $classes->where('id_level',$elev->niveau) as $class)
                                                            <option value="{{$class->id}}"
                                                                {{$class->id == $elev->class_id ? 'selected' : ''}}> {{$class->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <button type="submit" class="btn btn-outline-info btn-circle right modifElev"><i
                                                        class="fas fa-check"></i> Modifier</button>


                                            </form>
                                        </div>
                                    @endforeach
                                </div><!-- End Tab Contant -->



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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


@endsection
