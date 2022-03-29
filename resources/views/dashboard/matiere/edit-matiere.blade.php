@extends('layouts.app-admin')
@section('title', $title)
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="container">
        <div class="card-header">
            Edit Matiere Data
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                        <form method="POST" action="{{ route('matieres.update', $matiere->id ) }}">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group col-md-12">

                                        <label for="nom">Matiere:</label>
                                        <input type="text" class="form-control" name="nom" value="{{ $matiere->nom }}"/>
                                    </div>
                                    <div class="form-group col-md-12">

                                        <label for="coeff">Coefficient:</label>
                                        <input type="text" class="form-control" name="coeff" value="{{ $matiere->coefficient }}"/>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="module">Niveau </label>
                                        <select class="form-control @error('niveau') is-invalid @enderror" id="niveau" name="niveau">
                                            <option value="{{$matiere->niveau_id}}" selected>  </option>
                                            @foreach( $niveaux as $niveau)
                                                <option value="{{$niveau->id}}"{{$niveau->id == $matiere->niveau_id ? 'selected' : ''}} > {{$niveau->level}} </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="module">Module </label>
                                        <select class="form-control @error('modul') is-invalid @enderror"  id="modul" name="modul">
                                            <option value="{{$matiere->module_id}}" selected>  </option>
                                            @foreach($modules as $modul)

                                                <option value="{{$modul->id}}" {{$modul->id == $matiere->module_id ? 'selected' : ''}} >
                                                    {{$modul->nom_module}}
                                                </option>
                                                @endforeach


                                        </select>
                                    </div>


                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#niveau").change(function(){
                $value=$(this).val(),
                    console.log($value);
                $('#modul').empty();
                $('#modul').append('<option value="">--- choisir ---</option>')
                $.ajax({
                    url: "{{ url('admin/matieres/getModule') }}",
                    data:{"niveau":$value,},
                    method: 'GET',
                    success: function(data) {
                        var count=0;
                        $.each(data,function(k,v){
                            $('#modul').append($('<option>',{value: k, text: v}));
                            count++;
                        });
                        if(count==0){
                            $('#modul').empty();
                            $('#modul').append('<option value="">Aucun emploi disponible</option>')
                        }
                    },
                    error:function(data){
                        $('#modul').append('<option value="">Aucun emploi affecter</option>')
                    }
                });
            });
        });
    </script>
@endsection
