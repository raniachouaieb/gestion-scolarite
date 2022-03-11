@extends('layouts.app-admin')
@section('title', $title)

@section('content')
<style>
  .position {
    float: right;
  }
</style>
<div class="container">

@include('includes.alerts.flash')
<a  class="btn btn-primary position" href="{{ route('classes.add')}}"><i class="fas fa-plus"></i>Ajouter Classe</a>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Classe</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($class as $classroom)
        <tr>
            <th scope="row">1</th>
            <td>{{$classroom->id}}</td>
            <td>{{$classroom->name}}</td>
            <td><a href="{{ route('classes.edit', $classroom->id)}}" class="btn btn-primary"><i class="fas fa-pen fa-sm"></i></a>

                <form action="{{ route('classes.destroy', $classroom->id)}}"  method="post" class="d-inline" onsubmit="return confirm(' Etes vous sur pour supprimer ce niveau?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash fa-sm"></i></button>
                </form>
            </td>        </tr>
        @endforeach
        </tbody>
    </table>


<div>
@endsection
