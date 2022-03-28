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
                <li class="breadcrumb-item active" aria-current="page">Créer une séance</li>

            </ol>
        </nav>
        <!-- <div class="card-header">
             Créer une convocation
         </div>-->
        <div class="card-body">

            <form method="post" action="{{ route('seance.store') }}">
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

                                                            <option value="" >  </option>


                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Emploi</label>
                                                    <select class="form-control " id="emploi" name="emploi">
                                                        <option value="" selected> </option>
                                                        <option value="" > </option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Matière</label>
                                                    <select class="form-control @error('matiere') is-invalid @enderror "  id="elev" name="matiere">
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
                                                <div class="form-group ">
                                                        <label for="appt" class="col-md-8">heure debut:</label>
                                                    <div class="col">
                                                        <input  class="col-md-12" type="time" id="appt" name="appt">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="appt" class="col-md-8">heure fin:</label>
                                                    <div class="col">
                                                        <input  class="col-md-12" type="time" id="appt" name="appt">
                                                    </div>
                                                </div>


                                         </div>
                                    </div>
                                      </div>
                                  </div>
                             </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-outline-primary pos">Ajouter</button>


            </form>
        </div>




    </div>
    <script>
        $(document).ready(function(){
            $("#niveau").change(function(){
                $value=$(this).val(),
                    console.log($value);
                $('#class').empty();
                $('#class').append('<option value="">--- choisir ---</option>')
                $.ajax({
                    url: "{{ url('admin/convocations/getClasse') }}",
                    data:{"niveau":$value,},
                    method: 'GET',
                    success: function(data) {
                        var count=0;
                        $.each(data,function(k,v){
                            $('#class').append($('<option>',{value: k, text: v}));
                            count++;
                        });
                        if(count==0){
                            $('#class').empty();
                            $('#class').append('<option value="">Aucun Classe disponible</option>')
                        }
                    },
                    error:function(data){
                        $('#class').append('<option value="">Aucun classse affecter</option>')
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $("#class").change(function(){
                $value=$(this).val(),
                    console.log($value);
                $('#elev').empty();
                $('#elev').append('<option value="">--- Please select ---</option>')
                $.ajax({
                    url: "{{ url('admin/convocations/getEleve') }}",
                    data:{"class":$value,},
                    method: 'GET',
                    success: function(data) {
                        var count=0;
                        $.each(data,function(k,v){
                            $('#elev').append($('<option>',{value: k, text: v}));
                            //  $('#eleve').hide();
                            count++;
                        });
                        if(count==0){
                            $('#elev').empty();
                            $('#elev').append('<option value="">Aucun eleve disponible</option>')
                        }
                    },
                    error:function(data){
                        $('#elev').append('<option value="">Aucun eleve affecter</option>')
                    }
                });
            });
        });
    </script>



@endsection
