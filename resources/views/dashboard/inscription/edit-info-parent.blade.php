@extends('layouts.app-admin')
@section('title', $title)
@section('content')

<div class="container">


             <h1>Détaille</h1>
             <h3>Information Pere</h3>

             <form  method="post" action="{{ route('inscri.update', $parent->id ) }}">
             @csrf
                <div class="row mb-3">
                    <div class="col">
                    @method('PATCH')
                    <label for="nomPere">Nom </label>
                      <input type="text" class="form-control" name="nomPere" value="{{ $parent->nomPere }}"/>

                    </div>
                    <div class="col">
                    @method('PATCH')
                    <label for="prenomPere">Prénom </label>
                    <input type="text" class="form-control" name="prenomPere" value="{{ $parent->prenomPere }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                    <label for="professionPere">Profession</label>
                    <input type="text" class="form-control" name="professionPere" value="{{ $parent->professionPere }}"/>
                    </div>
                    <div class="col">
                    <label for="telPere">Téléphone</label>
                    <input type="text" class="form-control" name="telPere" value="{{ $parent->telPere }}"/>
                    </div>
                </div>
            

            <h3>Information Mere</h3>
             
                <div class="row mb-3">
                    <div class="col">
                    <label for="nomMere">Nom </label>
                      <input type="text" class="form-control" name="nomMere" value="{{ $parent->nomMere }}"/>

                    </div>
                    <div class="col">
                    <label for="prenomMere">Prénom </label>
                    <input type="text" class="form-control" name="prenomMere" value="{{ $parent->prenomMere }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                    <label for="professionMere">Profession </label>
                    <input type="text" class="form-control" name="professionMere" value="{{ $parent->professionMere }}"/>
                    </div>
                    <div class="col">
                    <label for="telMere">Téléphone </label>
                    <input type="text" class="form-control" name="telMere" value="{{ $parent->telMere }}"/>
                    </div>
                </div>
            

            <h3>Information Générale</h3>
            
                <div class="row mb-3">
                    <div class="col">
                    <label for="adresse">Adresse </label>
                      <input type="text" class="form-control" name="adresse" value="{{ $parent->adresse }}"/>

                    </div>
                    <div class="col">
                    <label for="email">Email </label>
                    <input type="text" class="form-control" name="email" value="{{ $parent->email }}"/>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="nbEnfants">Nombre Enfants </label>
                    <input type="number" class="form-control" name="nbEnfants" value="{{ $parent->nbEnfants }}"/>
                    </div>
                   
               
            

            <h3>Information Elève</h3>
             
                 @foreach($parent->student as $elev)
             
                <div class="row mb-3">
                    <div class="col">
                    <label for="nomEleve">Nom </label>
                      <input type="text" class="form-control" name="nomEleve" value="{{ $elev->nomEleve }}"/>

                    </div>
                    <div class="col">
                    <label for="prenomEleve">Prénom </label>
                    <input type="text" class="form-control" name="prenomEleve" value="{{ $elev->prenomEleve }}"/>
                    </div>
                </div>
                
<hr>
<button type="submit" class="btn btn-success btn-circle right"><i class="fas fa-check"></i></button>
                
                                    @endforeach
            </form>
         </div>
@endsection