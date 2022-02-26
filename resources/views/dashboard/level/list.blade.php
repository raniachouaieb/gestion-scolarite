@extends('layouts.app-admin')
@section('title', $title)

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
@include('includes.alerts.flash')  

<a  class="btn btn-primary" href="{{ route('levels.add')}}"><i class="fas fa-plus"></i>Ajouter Niveau</a>


<table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Level</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($levelName as $niveau)
        <tr>
            <td>{{$niveau->id}}</td>
            <td>{{$niveau->level}}</td>
            <td><a href="{{ route('levels.edit', $niveau->id)}}" class="btn btn-info "><i class="fas fa-pen fa-sm"></i></a>

   
            <form action="{{ route('levels.destroy', $niveau->id)}}" method="post" class="d-inline" onsubmit="return confirm(' Etes vous sur pour supprimer ce niveau?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger " type="submit"><i class="fas fa-trash fa-sm"></i></button>
 
                </form>
               
               <!-- <a class="btn btn-danger "  data-target="#ModalDlete{{$niveau->id}}"><i class="fas fa-trash fa-sm"></i></a>-->
 
                
                </td>
        </tr>
        @endforeach
    </tbody>
  </table>


<div>

<form action="{{ route('levels.destroy', $niveau->id) }}" method="post">
@csrf
@method('DELETE')
    <div class="modal fade" id="ModalDlete{{$niveau->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Supprimer niveau')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body"> Vous etes sur pur supprimer <b>{{$niveau->id}}</b>?</div>
<div class="modal-footer">
    <button type="button" class="btn gray btn-outline-secondary" data-dismiss="modal">{{ __('Annuler')}}</button>
    <button type="button" class="btn  btn-outline-danger" >Supprimer</button>

</div>
</div>
</div>
</div>
</form>
@endsection

