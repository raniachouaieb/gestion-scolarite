@extends('layouts.app-admin')

@section('content')
<style>
    .td-text-red td {color: red;}
</style>


    <div class="container">
        @include('includes.alerts.flash')

        <h2>Liste des parents acceptée</h2>

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
                                        <li>
                                       @if($elev->gender == 1) <span class="badge badge-danger">{{$elev->nomEleve }} {{$elev->prenomEleve }}</span>
                                        @else <span class="badge badge-info">{{$elev->nomEleve }} {{$elev->prenomEleve }}</span>
                                        @endif
                                        </li>
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
