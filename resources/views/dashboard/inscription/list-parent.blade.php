@extends('layouts.app-admin')



@section('content')



<div class="container">
@include('includes.alerts.flash')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Library</li>
        </ol>
    </nav>
<div class="card shadow mb-4">
                            <div class="table-responsive">
                            <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th> Père</th>
                                            <th>Télephhone </th>
                                            <th> Mère </th>
                                            <th>Télephone </th>
                                            <th>Email</th>
                                            <th>Enfants</th>
                                            <th colspan="1">Action</th>
                                        </tr>
                                    </thead>



                                    <tbody>
                                    @foreach($parent as $par)
                                        <tr>
                                            <td>{{$par->nomPere}} {{$par->prenomPere}}</td>


                                            <td>{{$par->telPere}}</td>
                                            <td>{{$par->nomMere}} {{$par->prenomMere}}</td>

                                            <td>{{$par->telMere}}</td>

                                            <td>{{$par->email}}</td>
                                            <td> @foreach($par->student as $elev)
                                              <ul>
                                               <li>{{$elev->nomEleve }} {{$elev->prenomEleve }}</li>

                                              </ul>
                                              @endforeach
                                            </td>
                                            <td><a href="{{ route('isncri.edit', $par->id)}}" class="btn btn-info btn-circle"><i class="fas fa-pen fa-sm"></i></a></td>


                                        </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>
                        </div>
</div>



@endsection
