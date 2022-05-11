@extends('layouts.app-admin')

@section('title', $title)
@section('content')
    <style>
        .pos {
            float: right;
            margin-right: 92px;
            margin-top: 27px;
            width: 153px;
        }
        .editcard{
            margin-left: 55px;
            margin-top: 25px;
        }
        .imgcard{
            margin-top: 100px;
            margin-right: 15px;
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
    </style>
    <div class="container">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('menu.index')}}">Cantine</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modifier le menu</li>

            </ol>
         </nav>


                <form method="post" action="{{ route('menu.updateMenu', $menu->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$menu->id}}" name="id_menu" id="id_menu"/>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="card editcard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for=""  class="col-md-8">Date</label>
                                            <div class="col">
                                                <input id="date" type="date" class="form-control  @error('date') is-invalid @enderror" name="date" value="{{$menu->date}}">
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
                                                <input id="jour" type="text" name="jour"  value="{{$menu->jour}}"class="form-control @error('jour') is-invalid @enderror">
                                                @error('jour')
                                                <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="" class="col-md-6" >Menu</label>
                                        <div class="col">
                                            <textarea id="myarea" name="menu">{{$menu->menu}}</textarea>
                                        </div>
                                    </div>
                                    <br>
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
                                            <div class="image" ><img  src="{{asset('assets/'.$menu->image)}}")}} id="output" class="profilImg"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary pos">Modifier</button>

                        </div>

                     </div>


                 </form>




     </div>
    <script>
        var loadFile= function(event){
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };

    </script>

@endsection
