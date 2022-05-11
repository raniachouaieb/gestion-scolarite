@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .color{
            color: #ef6f6c;
        }
        .seanceAdd{
            margin-left: 889px;
            width: 121px;
        }
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('seance.index')}}">Séances</a></li>
                <li class="breadcrumb-item active" aria-current="page">Créer une séance</li>

            </ol>
        </nav>

        <div class="card-body">

            <form method="post" action="{{ route('seance.store') }}">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="card-title color"><i class="fa fa-pen"></i> Créer la séance</h5>
                                <hr />

                                <div class="mb-3">
                                    <label for="">Niveau</label>
                                    <select class="form-control @error('niveau') is-invalid @enderror  "  id="niveau" name="niveau">
                                        <option value="" selected> Choisir </option>
                                        @foreach($niveaux as $niveau)
                                            <option value="{{$niveau->id}}" > {{$niveau->level}} </option>
                                        @endforeach

                                    </select>
                                    @error('niveau')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <h5 class="card-title color"><i class="fa fa-business-time"></i> Fixer l'heure</h5>
                                <hr />
                                <div class="mb-3">
                                    <label for="" class="col-md-8">Jour</label>

                                        <select class="form-control @error('day') is-invalid @enderror"  name="day">
                                            <option value="" selected>  Selectionner un jour  </option>
                                            <option value="Lundi" > Lundi </option>
                                            <option value="Mardi" > Mardi </option>
                                            <option value="Mercredi" > Mercredi </option>
                                            <option value="jeudi" > jeudi </option>
                                            <option value="vendredi" > vendredi </option>
                                            <option value="samedi" > samedi </option>

                                        </select>
                                        @error('day')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-8">

                                <div class="mb-3">
                                    <label for="">Emploi</label>
                                    <select class="form-control @error('emploi') is-invalid @enderror  " id="emploi" name="emploi">
                                        <option value="" selected> </option>
                                        <option value="" > </option>
                                    </select>
                                    @error('emploi')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <!--/span-->
                            <div class="col-md-4">

                                <div class="mb-3">
                                    <label for="" class="col-md-8">heure debut:</label>

                                        <input  class="col-md-12 form-control @error('start_time') is-invalid @enderror" type="time" id="start_time" name="start_time">
                                        @error('start_time')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                                    </span>
                                        @enderror
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-8">

                                <div class="mb-3">
                                    <label for="">Matière</label>
                                    <select class="form-control @error('matiere') is-invalid @enderror "  id="matiere" name="matiere">
                                        <option value="" selected>  </option>
                                        <option value="" >  </option>

                                    </select>
                                    @error('matiere')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <!--/span-->
                            <div class="col-md-4">

                                <div class="mb-3">
                                    <label for="" class="col-md-8">heure fin:</label>
                                        <input  class="col-md-12 form-control @error('end_time') is-invalid @enderror" type="time" id="end_time" name="end_time">
                                        @error('end_time')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                                    </span>
                                        @enderror
                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <button type="submit" class="btn btn-outline-danger seanceAdd px-4">Ajouter</button>
                    </div>
                </div>




            </form>
        </div>




    </div>
    <script>
        $(document).ready(function(){
            $("#niveau").change(function(){
                $value=$(this).val(),
                    console.log($value);
                $('#emploi').empty();
                $('#emploi').append('<option value="">--- choisir ---</option>')
                $.ajax({
                    url: "{{ url('admin/seance/getEmploi') }}",
                    data:{"niveau":$value,},
                    method: 'GET',
                    success: function(data) {
                        var count=0;
                        $.each(data,function(k,v){
                            $('#emploi').append($('<option>',{value: k, text: v}));
                            count++;
                        });
                        if(count==0){
                            $('#emploi').empty();
                            $('#emploi').append('<option value="">Aucun emploi disponible</option>')
                        }
                    },
                    error:function(data){
                        $('#emploi').append('<option value="">Aucun emploi affecter</option>')
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $("#niveau").change(function(){
                $value=$(this).val(),
                    console.log($value);
                $('#matiere').empty();
                $('#matiere').append('<option value="">--- choisir ---</option>')
                $.ajax({
                    url: "{{ url('admin/seance/getMatiere') }}",
                    data:{"niveau":$value,},
                    method: 'GET',
                    success: function(data) {
                        var count=0;
                        $.each(data,function(k,v){
                            $('#matiere').append($('<option>',{value: k, text: v}));
                            count++;
                        });
                        if(count==0){
                            $('#matiere').empty();
                            $('#matiere').append('<option value="">Aucune matiere disponible</option>')
                        }
                    },
                    error:function(data){
                        $('#matiere').append('<option value="">Aucune matiere a affecter</option>')
                    }
                });
            });
        });
    </script>





@endsection
