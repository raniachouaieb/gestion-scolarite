@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .pos {
            float: right;
            margin-right: 100px;
            margin-top: -11px;
            width: 138px;

        }
        .pp{
            margin-top: 15px;
        }
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('seance.index')}}">Séances</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mettre à jour une séance</li>

            </ol>
        </nav>

        <div class="card-body">

            <form method="post" action="{{route('seance.update', $seances->id)}}">
                @csrf
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="card tt">
                            <div class="card-body">
                                <div class="col">

                                    <div class="card-body">
                                        <div class="form-group col-md-12">
                                            <label for="">Niveau</label>
                                            <select class="form-control "  id="niveau" name="niveau">
                                                <option value="" selected> Choisir </option>
                                                @foreach($niveaux as $niveau)
                                                    <option value="{{$niveau->id}}" {{$niveau->id == $seances->emploi['niveau_id'] ? 'selected':''}} > {{$niveau->level}} </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="">Emploi</label>
                                            <select class="form-control " id="emploi" name="emploi">
                                                <option value="{{$seances->emploi_id}}" > </option>
                                                @foreach($emplois as $empl)
                                                <option value="{{$empl->id}}" {{$empl->id == $seances->emploi_id ? 'selected':''}}> {{$empl->titre}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="">Matière</label>
                                            <select class="form-control @error('matiere') is-invalid @enderror "  id="matiere" name="matiere">
                                                <option value="{{$seances->matiere_id}}" selected>  </option>
                                                @foreach($matiere as $mat)
                                                <option value="{{$mat->id}}" {{$mat->id == $seances->matiere_id ? 'selected' :''}} > {{$mat->nom}} </option>
                                                @endforeach

                                            </select>
                                            @error('matiere')
                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                                    </span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card-body">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group col-md-12">
                                            <label for="" class="col-md-8">Jour</label>
                                            <div class="col">
                                                <select class="form-control @error('day') is-invalid @enderror"  name="day" >
                                                    <option value="{{$seances->day}}" selected>  {{$seances->day}}  </option>
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
                                            <div class="form-group ">
                                                <label for="appt" class="col-md-8">heure debut:</label>
                                                <div class="col">
                                                    <input  class="col-md-12" type="time"  name="start_time" value="{{$seances->start_time}}">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="appt" class="col-md-8">heure fin:</label>
                                                <div class="col">
                                                    <input  class="col-md-12" type="time"  name="end_time" value="{{$seances->end_time}}">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-outline-primary pos">Modifier</button>


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
