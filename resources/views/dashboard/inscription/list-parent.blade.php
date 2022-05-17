@extends('layouts.app-admin')



@section('content')

<style>
    .position-relative {
        position: relative!important;
    }

    .ps-3 {
        padding-left: 1rem!important;
    }
    .box{
        box-shadow: 3px 3px 2px ;
        border-radius: 5px 5px 5px;
        border: 1px ;
        margin-bottom: 15px;
    }
    .table-responsive table thead tr{color: #ffffff;
        font-family: 'Nunito', sans-serif;
        font-weight: inherit}
</style>

<div class="container">
@include('includes.alerts.flash')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Liste Parents préinscrits</li>
        </ol>
    </nav>
<div class="card shadow mb-4 mt-5">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="bg-primary">
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
                                            <td> @foreach($par->students as $elev)
                                              <ul>
                                               <li>{{$elev->nomEleve }} {{$elev->prenomEleve }}</li>

                                              </ul>
                                              @endforeach
                                            </td>
                                            <td><a href="{{ route('isncri.edit', $par->id)}}" ><i class="fas fa-pen fa-sm "></i></a></td>


                                        </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>
                        </div>
</div>



@endsection
