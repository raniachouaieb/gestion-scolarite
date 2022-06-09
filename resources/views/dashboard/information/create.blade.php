@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .btnAjout{
            margin-left: 379px;
            width: 150px;
        }

    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('info.index')}}">Informations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Créer une information</li>

            </ol>
        </nav>

        <div class="card-body">

            <form method="post" action="{{route('info.store')}}">

                    <div class="col-md-12 ">
                        <div class="card tt">
                            <div class="card-body">
                                <div class="headers-line mt-md" style="color: #ef6f6c;"><i class="fas fa-plus"></i> {{__(' nouveau information')}}</div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        @csrf
                                        <label for=""> Titre: </label>
                                        <input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre"/>
                                        @error('titre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                 </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Niveau</label>
                                        <select class="form-control "  id="niveau" name="niveau">
                                            <option value="" selected> Choisir </option>
                                            @foreach($niveaux as $niv)
                                                <option value="{{$niv->id}}" > {{$niv->level}} </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label for="">Classe</label>
                                        <select class="form-control "  id="class" name="class">
                                            <option value="" selected> Choisir </option>
                                                <option value="" >  </option>

                                        </select>
                                    </div>
                                </div>


                                <br>
                                <div class="form-group">
                                    <label for="">Description </label>
                                    <textarea id="myarea" name="info" class="form-control tinymce-editor @error('info') is-invalid @enderror" ></textarea>
                                    @error('info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-outline-primary btnAjout">Créer</button>

                            </div>

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
                $('#class').empty();
                $('#class').append('<option value="">--- choisir ---</option>')
                $.ajax({
                    url: "{{ url('admin/info/getClasse') }}",
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
