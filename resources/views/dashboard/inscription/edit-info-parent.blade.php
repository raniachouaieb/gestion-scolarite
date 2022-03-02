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
                   
                    <label for="nomPere">Nom </label>
                      <input type="text" class="form-control" name="nomPere" value="{{ $parent->nomPere }}"/>

                    </div>
                    <div class="col">
                    
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
                    <div class="col-md-6">
                    <label for="nbEnfants">Nombre Enfants </label>
                    <input type="number" class="form-control" name="nbEnfants" value="{{ $parent->nbEnfants }}"/>
                    </div>
                    <button type="submit" class="btn btn-success btn-circle right"><i class="fas fa-check"></i></button>

               
</form>

           
        <div class="container test">
        <div class="row">
            <div class="col-md-8">
                <h1>Elèves</h1>
                <div class="tab-container-one">
                    <ul class="nav nav-tabs">
                    @foreach($parent->student as $index=>$elev)
                        <li class="nav-item @if($index==0) active @endif">
                            <a class="nav-link @if($index==0) active @endif" href="#home{{$index}}" data-toggle="tab" aria-controls="home{{$index}}">Elève{{$index}}</a></li>
                        @endforeach
                    </ul>
                   
                    <div class="tab-content">

                        @foreach($parent->student as $index=>$elev)
                        
                        <div role="tabpanel" class="tab-pane @if($index==0) active @endif" id="home{{$index}}" aria-labelledby="home-tab{{$index}}">
                            
                            <form method="post" action="{{ route('inscri.updateEleve', $elev->id ) }}">
                            @csrf
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

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="gender">gender </label>
                                        <select class="form-control"  name="gender">
                                            <option value="{{ $elev->gender }}" selected>{{ $elev->gender==0 ? 'Garcon' : 'Fille' }}</option>
                                        
                                            <option value="garcon" > Garçon </option>
                                            <option value="fille" > Fille </option>
                                        </select>
                                    </div>

                                    <div class="col">
                                    <label for="niveau">niveau </label>
                                    
                                    
                                   <input type="text" class="form-control" name="niveau" value="{{ $elev->niveau }}"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="classe">classe </label>
                                    <select class="form-control"  name="classe">
                                        <option value="" selected> {{$elev->classe}} </option>
                                        @foreach( $classes as $class)
                                            <option value="{{$class->id}}" > {{$class->name}} </option>
                                        @endforeach                                  
                                    </select>  
                                </div>

                            
                            <button type="submit" class="btn btn-success btn-circle right"><i class="fas fa-check"></i></button>

                            
                            </form>
                        </div>
                        @endforeach
                    </div><!-- End Tab Contant -->
                    
                   
                    
                </div>
            </div>
        </div>
    </div>

                 

            

         </div>

        
@endsection