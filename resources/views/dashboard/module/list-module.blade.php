@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .position {
            float: right;
            margin-right: 20px;
        }
        .moduleTab{
            margin-top: 70px;
            margin-left: 18px;
        }
        .colrtrash{
            color: red;
            margin-left: 7px;
        }
    </style>
    <div class="container">
    <!--@include('includes.alerts.flash')  -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modules</li>
            </ol>
        </nav>
        <div class="row  position mb-5">
            <a  class="btn btn-primary position" href="{{ route('modules.add')}}"><i class="fas fa-plus"></i></a>
        </div>

        <div class="card shadow mb-6 moduleTab">
            <div class="table-responsive">

        <table class="table table-hover">
            <thead>
            <tr>
                <td class="col-1">#</td>
                <td class="col-6">Nom</td>
                <td class="col-3">Coefficient</td>
                <td class="col-2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($module as $modul)
                <tr>
                    <td class="col-1">{{$modul->id}}</td>
                    <td class="col-6"><a href="{{route('modules.show', $modul->id)}}" class="btn btn-info" data-toggle="collapse" data-target="#demo{{ $modul->id}}">{{$modul->nom_module}}</a></td>
                    <td class="col-3">{{$modul->coefficient_module}}</td>
                    <td class="col-2"><a href="{{route('modules.edit', $modul->id)}}"  type="submit" ><i class="fas fa-pen fa-sm"></i></a>


                        <form action="{{route('modules.destroy', $modul->id)}}" method="post" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <a ><i class="fas fa-trash fa-sm colrtrash"></i></a>


                        </form>
                    </td>
                </tr>
                <div  id="demo{{ $modul->id}}" class="collapse" >
                    <ul>
                        @foreach($modul->matiere as $listMat)

                            <li>{{$listMat->nom}}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            </tbody>

        </table>


            </div>

        </div>



@endsection

