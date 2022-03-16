@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .position {
            float: right;
        }
    </style>
    <div class="container">
    <!--@include('includes.alerts.flash')  -->
        <a  class="btn btn-primary position" href="{{ route('modules.add')}}"><i class="fas fa-plus"></i>Ajouter Module</a>


        <table class="table table-hover">
            <thead>
            <tr>
                <td>#</td>
                <td>Nom</td>
                <td>Coefficient</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($module as $modul)
                <tr>
                    <td>{{$modul->id}}</td>
                    <td><a href="" >{{$modul->nom_module}}</a></td>
                    <td>{{$modul->coefficient_module}}</td>
                    <td><a href="{{route('modules.edit', $modul->id)}}" class="btn btn-info "><i class="fas fa-pen fa-sm"></i></a>


                        <form action="{{route('modules.destroy', $modul->id)}}" method="post" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger " type="submit"><i class="fas fa-trash fa-sm"></i></button>

                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <div>
@endsection

