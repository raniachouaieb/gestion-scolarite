@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .image{
            display: grid;
            height: 100%;
            place-items: center;
            text-align: center;
        }
        .img{
            width: 150px;
            height: 150px;
            float: left;
            border-radius: 50%;
            margin-right: 25px;
            margin-left: 76px;
        }
        .container{
            height: 350px;
            width: 430px;
            border: 2px dashed #c2cdda;
            margin-top: 35px;
        }
        .file{
            margin-left: 358px;
            margin-top: 16px;
        }

        .upload{
            margin-left: 288px;
            margin-top: 15px;
            width: 95px;
        }
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier image de profil</li>

        </ol>
    </nav>
<div class="container image">


    <div class="row">
        <div class="col-md-12 col-ms-offset-5">
            <img src="{{asset('assets/'.$user->image)}}" class="img"  >
             <h2>{{$user->name}}'s profile</h2>

        </div>
    </div>
</div>
    <form enctype="multipart/form-data" action="{{route('Updateprofile', $user->id)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-4">
                <input type="file" name="image" class="file">
            </div>

            <div class="col-4">
                <button type="submit" class=" pull-right btn btn-sm btn-outline-primary upload">Upload</button>
            </div>
        </div>
    </form>
@endsection
