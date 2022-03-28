@extends('layouts.app-admin')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('convocations.index')}}">Convocations</a></li>

            </ol>
        </nav>

        <form  method="get" action="{{route('convocations.search')}}">
            @csrf
            <br>
            <div class="container">
                <div class="row">
                    <div class="form-group row search">
                        <div class="col-sm-9">
                            <input class="form-control mr-sm-2" name="query" type="search" placeholder="chercher">
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-outline-info my-2 my-sm-0" type="submit"> <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="card shadow mb-4 convTab">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th> Titre</th>
                    <th>Raison </th>
                    <th>Date Réunion </th>
                    <th>Eleve</th>
                    <th>Pere</th>
                    <th>Telephone</th>
                    <th colspan="2">Opérations</th>
                </tr>
                </thead>



                <tbody>
                @if($convocations && $convocations->count()>0)
                    @foreach($convocations as $conv)
                        <tr>
                            <td>{{$conv->titre_conv}} </td>
                            <td>{!! $conv->description !!}</td>
                            <td>{{$conv->date_envoie}}</td>

                            <td>{{$conv->student['nomEleve']}} {{$conv->student['prenomEleve']}}</td>


                            <td>{{$conv->student->parent['nomPere']}} {{$conv->student->parent['prenomPere']}}</td>
                            <td>{{$conv->student->parent['telPere']}}</td>

                            <td>
                                <form action="{{ route('convocations.destroy', $conv->id)}}" method="post" class="d-inline" >
                                    @csrf
                                    @method('DELETE')
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a type="submit"  class=" show_confirm iconSupp" data-toggle="tooltip" title='Delete'><i class="fas fa-trash trashcolor"></i></a>
                                </form>

                            </td>


                        </tr>
                    @endforeach
                @endif


                </tbody>
            </table>

        </div>


    </div>
@endsection
