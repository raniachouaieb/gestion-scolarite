@extends('layouts.app-admin')

@section('content')



<div class="container">
    
<div class="card shadow mb-4">
   
                            <div class="table-responsive">
                            <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom pere</th>
                                            <th>prenom pere</th>
                                            <th>profession pere</th>
                                            <th>telephhone pere</th>
                                            <th>Nom mere </th>
                                            <th>prenom mere</th>
                                            <th>profession mere </th>
                                            <th>telephone mere</th>
                                            <th>nombre enfants</th>

                                            <th>Adresse</th>
                                            <th>Email</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    
                                       
                                    
                                    <tbody>
                                    @foreach($parent as $par)
                                        <tr>
                                            <td>{{$par->nomPere}}</td>
                                            <td>{{$par->prenomPere}}</td>
                                            <td>{{$par->professionPere}}</td>
                                            <td>{{$par->telPere}}</td>
                                            <td>{{$par->nomMere}}</td>
                                            <td>{{$par->prenomMere}}</td>
                                            <td>{{$par->professionMere}}</td>
                                            <td>{{$par->telMere}}</td>
                                            <td>{{$par->nbEnfants}}</td>
                                            <td>{{$par->adresse}}</td>
                                            <td>{{$par->email}}</td>
                                         
                                    
                                            <td><a href="{{ route('isncri.edit', $par->id)}}" class="btn btn-info btn-circle"><i class="fa-solid fa-pencil"></i></a></td>


                                        </tr>
                                        @endforeach
                                      
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
          
@endsection