@extends('layouts.app-admin')

@section('title', $title)
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notes</li>

            </ol>
        </nav>

        <div class=" card shadow mb-5 cardNivClass">
            <div class=" row niv">
                @foreach($niveaux as $niv)

                        <div class="btn-group ml-4 mb-1  " id="niveau{{ $niv->id}}" >
                                <button type="button" class="btn btn-outline-danger mt-2" style="margin-left: 29px" value="{{$niv->id}}" id="button">{{$niv->level}}</button>
                        </div>



                @endforeach

            </div>

        </div>
    </div>
@stop
