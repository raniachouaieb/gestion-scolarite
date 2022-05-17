@extends('layouts.app-admin')

@section('content')
    <style>
        .pencil{
            margin-left: 19px;
        }
        .table-responsive table thead tr{color: #ffffff;
            font-family: 'Nunito', sans-serif;
            font-weight: inherit}
    </style>
    <div class="container">
   <!-- <div class="row mb-2"><h6><span class="countEleve mr-2">{{$elevePreInscrit->count()}}</span>Eleve Pré-Inscrits </h6></div>-->

       @include('includes.alerts.flash')
       <nav aria-label="breadcrumb">
           <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Elèves Pré-Inscrits</li>
           </ol>
       </nav>
    <div class=" card shadow listEleve mb-4 mt-5">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="bg-primary">
                <tr>
                    <th classe="col-4"> Elève</th>
                    <th classe="col-3">Niveau </th>
                    <th classe="col-3"> Gender </th>
                    <th classe="col-2">Action</th>
                </tr>
                </thead>



                <tbody>
                @foreach($elevePreInscrit as $getstudentpreinscri)
                    <tr>
                        <td classe="col-4">{{$getstudentpreinscri->nomEleve}} {{$getstudentpreinscri->prenomEleve}}</td>


                        <td classe="col-3">@foreach($niveaux as $level) @if($level->id == $getstudentpreinscri->niveau){{$level->level}} @endif @endforeach</td>
                        <td classe="col-3">{{$getstudentpreinscri->gender==0 ? 'Garcon' : 'Fille'}}</td>
                        <td classe="col-2"><a href="{{route('student.edit', $getstudentpreinscri->id)}}" ><i class="fas fa-pen fa-sm pencil"></i></a></td>



                    </tr>
                @endforeach



                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
