@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .image{
            display: grid;
            height: 350px;
            place-items: center;
            text-align: center;
            width: 430px;
            border: 2px dashed #c2cdda;
            margin-top: 102px;
            margin-left: 287px;
        }
        .img{
            width: 150px;
            height: 150px;
            float: left;
            border-radius: 50%;
            margin-right: 25px;
            margin-left: 118px;
            margin-top: 84px;
        }

        .file{
            margin-left: -88px;
            margin-top: 16px;
        }

        .upload{
            margin-left: 288px;
            margin-top: -57px;
            margin-right: -22px;

        }

    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier image de profil</li>

        </ol>
    </nav>
<div class="container ">
    <div class="image">

            <form enctype="multipart/form-data" action="{{route('Updateprofile', $user->id)}}" method="post">
                @csrf


                <img  id ="preview-img" src="{{asset('assets/'.$user->image)}}" class="img"  >
                    <h2 style="margin-right: 58px;">{{$user->name}}'s profile</h2>
                <div class="row">
                    <div class="col-12">
                    <input type="file"  name="image" id="image-input" class="file" onchange="loadFile(event)">
                    </div>
                    <div class="col-12">
                        <button type="submit" class=" pull-right btn btn-sm btn-outline-primary upload">Upload</button>
                    </div>
                </div>

            </form>


    </div>
</div>



    <script>
        var loadFile= function(event){
            var previewImage = document.getElementById('preview-img');
            previewImage.src = URL.createObjectURL(event.target.files[0]);
        };

    </script>
@endsection
