@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .position {
            float: right;
            margin-right: 25px;
        }
        .tableNiveau{
            margin-top: 70px;
        }
        .trash{
            color:red;
            margin-left: 7px;
        }
        .table-responsive table thead tr{color: #ffffff;
            font-family: 'Nunito', sans-serif;
            font-weight: inherit}
    </style>
    <div class="container">
    <!--@include('includes.alerts.flash')  -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Suggestionn</li>
            </ol>
        </nav>




        <div class="card shadow tableNiveau">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead class="bg-primary">
                    <tr>
                        <td class="col-4"> {{__('Parent')}}</td>
                        <td class="col-6">{{__('Sujet')}}</td>
                        <td class="col-2">{{__('Suggestion')}}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listSuggestion as $suggestion)
                        <tr>
                            <td class="col-4"> {{$suggestion->parent['nomPere']}}  {{$suggestion->parent['prenomPere']}}</td>
                            <td class="col-6">{{$suggestion->sujet}}</td>
                            <td class="col-2">{{$suggestion->detail}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>








@endsection

