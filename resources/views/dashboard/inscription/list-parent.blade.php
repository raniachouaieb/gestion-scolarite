@extends('layouts.app-admin')

@section('content')



<div class="container">
@include('includes.alerts.flash')

<div class="card shadow mb-4">
                            <div class="table-responsive">
                            <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Père</th>
                                            
                                            <th>profession pere</th>
                                            <th>telephhone pere</th>
                                            <th> Mère </th>
                                            <th>profession mere </th>
                                            <th>telephone mere</th>
                                            <th>nombre enfants</th>

                                            <th>Adresse</th>
                                            <th>Email</th>
                                            <th>Enfants</th>
                                            
               
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    
                                       
                                    
                                    <tbody>
                                    @foreach($parent as $par)
                                        <tr>
                                            <td>{{$par->nomPere}} {{$par->prenomPere}}</td>
                                           
                                            <td>{{$par->professionPere}}</td>
                                            <td>{{$par->telPere}}</td>
                                            <td>{{$par->nomMere}} {{$par->prenomMere}}</td>
                                          
                                            <td>{{$par->professionMere}}</td>
                                            <td>{{$par->telMere}}</td>
                                            <td>{{$par->nbEnfants}}</td>
                                            <td>{{$par->adresse}}</td>
                                            <td>{{$par->email}}</td>
                                            <td> @foreach($par->student as $elev)
                                              <ul>
                                               <li>{{$elev->nomEleve }} {{$elev->prenomEleve }}</li>
                                               
                                              </ul>
                                              @endforeach
                                            </td>
                                         
                                    
                                            <td><a href="{{ route('isncri.edit', $par->id)}}" class="btn btn-info btn-circle"><i class="fas fa-pen fa-sm"></i></a></td>
                                            <td>

                                            <?php if($par->is_active == '1'){ ?>
                                            <a href="{{ route('inscri.chagestatus', $par->id)}}" class="btn btn-success">Active</a>

                                            <?php }else{ ?>
                                                <a href="{{ route('inscri.chagestatus', $par->id)}}" class="btn btn-danger">InActive</a>
                                                <?php  } ?>


                                            

                                        
                                            </td>


                                        </tr>
                                        @endforeach
                                      
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
</div>


          
@endsection
