@extends('layouts.app-admin')

@section('title', $title)
@section('content')
    <style>
        .pos {
            float: right;
            margin-right: 138px;
            margin-top: 27px;
            width: 153px;
        }
        .addCard{

            margin-left: 55px;
            margin-top: 25px;

        }
        .customFile{
            font-size: 16px;
            background: white;
            border-radius: 50px;
            box-shadow: 5px 5px 10px black;
            width: 280px;
            outline: none;
            margin-left: -1px;
            margin-top: -5px;
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
        .image{
            border: 2px dashed #c2cdda;
            padding: 34px;
            margin-top: 47px;
            width: 53%;
            margin-left: 74px;

        }
        .profilImg{
            width: 144px;
            height: 100px;
            margin-left: -32px;
            border: none;
        }
        .profil{
            margin-top: 17px;
        }
        .imgcardadd{
            margin-top: 100px;
            margin-right: 15px;
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
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('menu.index')}}">Cantine</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ajouter un nouveau menu</li>

            </ol>
        </nav>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12">
                <div class="card material-card">
                    <div class="card-body">

<!--                        <form method="post" action="{{ route('menu.storeMenu') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="card-title color"><i class="fa fa-info-circle"></i> Informations personnelles</h5>
                                            <hr />
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="mb-3">
                                                        <label for=""  class="col-md-8">Date</label>
                                                        <div class="col">
                                                            <input id="date" type="date" class="form-control  @error('date') is-invalid @enderror" name="date" />
                                                            @error('date')
                                                            <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5"> <label for="" class="col-md-8">Jour</label>
                                                    <div class="col">
                                                        <select class="form-control @error('jour') is-invalid @enderror"  name="jour">
                                                            <option value="" selected>  Selectionner un jour  </option>
                                                            <option value="Lundi" > Lundi </option>
                                                            <option value="Mardi" > Mardi </option>
                                                            <option value="Mercredi" > Mercredi </option>
                                                            <option value="jeudi" > jeudi </option>
                                                            <option value="vendredi" > vendredi </option>
                                                            <option value="samedi" > samedi </option>

                                                        </select>
                                                        @error('jour')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        &lt;!&ndash;/span&ndash;&gt;
                                        <div class="col-md-4">
                                            <h5 class="card-title color"><i class="fa fa-info-circle"></i> Information communes</h5>
                                            <hr />
                                            <div class="mb-3">
                                            </div>
                                        </div>
                                        &lt;!&ndash;/span&ndash;&gt;
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">

                                            <label for="" class="col-md-5 ">Menu</label>
                                            <div class="col">
                                                <textarea id="myarea" name="menu" class="form-control tinymce-editor @error('menu') is-invalid @enderror"></textarea>
                                                @error('menu')
                                                <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        &lt;!&ndash;/span&ndash;&gt;
                                        <div class="col-md-4">
                                            <img src="{{asset('assets/uploads/parents/placeholderImage.png')}}"  onclick="clickImage()" id="profileDisplay" alt="fgh"/>

                                            <input type="file" name="image_profile" id="imageProfile" onchange="loadFile(event)" style="display: none;">


                                        </div>
                                        &lt;!&ndash;/span&ndash;&gt;
                                    </div>
                                    <button type="submit" class="btn btn-primary pos">Ajouter</button>

                                </div>

                            </div>

                        </form>-->
    <form method="post" action="{{ route('menu.storeMenu') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card addCard shadow">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-6">
                                <label for=""  class="col-md-8">Date</label>
                                <div class="col">
                                    <input id="date" type="date" class="form-control  @error('date') is-invalid @enderror" name="date">
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-6">
                                <label for="" class="col-md-8">Jour</label>
                                <div class="col">
                                    <select class="form-control @error('jour') is-invalid @enderror"  name="jour">
                                        <option value="" selected>  Selectionner un jour  </option>
                                        <option value="Lundi" > Lundi </option>
                                        <option value="Mardi" > Mardi </option>
                                        <option value="Mercredi" > Mercredi </option>
                                        <option value="jeudi" > jeudi </option>
                                        <option value="vendredi" > vendredi </option>
                                        <option value="samedi" > samedi </option>

                                    </select>
                                    @error('jour')
                                    <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror

                                </div>


                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="col-md-6 ">Menu</label>
                            <div class="col">
                                <textarea id="myarea" name="menu" class="form-control tinymce-editor @error('menu') is-invalid @enderror"></textarea>
                                @error('menu')
                                <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
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
                                <div class="image" ><img  src="{{asset('assets/uploads/parents/placeholderImage.png')}}" id="output" class="profilImg" ></div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary pos">Ajouter</button>
            </div>

        </div>
    </form>


                    </div>
                </div>
            </div>
        </div>





    </div>

    <script>
        var loadFile= function(event){
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            console.log(output);
        };

    </script>

@endsection
