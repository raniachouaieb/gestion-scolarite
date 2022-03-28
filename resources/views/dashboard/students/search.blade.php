@extends('layouts.app-admin')

@section('content')

    <div class="container">
        @include('includes.alerts.flash')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('student.index')}}">Elèves Inscrits</a></li>
            </ol>
        </nav>
        <div class=" card shadow mb-5">
            <div class="row">
                @foreach($niveaux as $niv)

                    <div class="col-4">
                        <a type="" class=" col-5 ml-3 mt-2" data-target="#classNiveau{{ $niv->id}}">{{$niv->level}}</a>
                        <div class="row">
                            <div class="btn-group ml-4 mb-1  " id="class{{ $niv->id}}" >
                                @foreach($niv->classes as $listClass)
                                    <button type="button" class="btn btn-outline-danger mt-2" value="{{$listClass->id}}" id="button">{{$listClass->name}}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

        </div>

        <table class="table table-hover">
    <thead>
    <tr>
        <th> Elève</th>
        <th>Classe</th>
        <th>Niveau </th>
        <th> Gender </th>
        <th colspan="1">Action</th>
    </tr>
    </thead>



    <tbody>
    @foreach($eleveByClass as $getstudent)
        <tr>
            <td>{{$getstudent->nomEleve}} {{$getstudent->prenomEleve}}</td>

            <td> @foreach($class as $classe) @if($classe->id == $getstudent->classe) {{$classe->name}} @endif   @endforeach</td>

            <td>@foreach($niveaux as $level) @if($level->id == $getstudent->niveau){{$level->level}} @endif @endforeach</td>
            <td>{{$getstudent->gender==0 ? 'Garcon' : 'Fille'}}</td>
            <td><a href="{{route('student.edit', $getstudent->id)}}" ><i class="fas fa-pen fa-sm pencil"></i></a></td>



        </tr>
    @endforeach



    </tbody>
</table>
@endsection
