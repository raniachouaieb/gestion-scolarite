@extends('layouts.app-admin')
@section('title', $title)
@section('content')



<div class="container">
@include('includes.alerts.flash')

<div class="card shadow mb-4">
                            <div class="table-responsive">
                            <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Elève</th>

                                            <th>Classe</th>
                                            <th>Niveau </th>
                                            <th> Sex </th>

                                            <th colspan="1">Action</th>
                                        </tr>
                                    </thead>



                                    <tbody>
                                    @foreach($student as $getstudent)
                                        <tr>
                                            <td>{{$getstudent->nomEleve}} {{$getstudent->prenomEleve}}</td>
                                            <td>{{$getstudent->classe}}</td>
                                            <td>{{$getstudent->niveau}}</td>
                                            <td>{{$getstudent->gender==0 ? 'Garcon' : 'Fille'}}</td>



                                            <td><a href="" class="btn btn-info btn-circle"><i class="fas fa-pen fa-sm"></i></a></td>



                                        </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>
                        </div>
</div>



@endsection
