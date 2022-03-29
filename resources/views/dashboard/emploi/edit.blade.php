@extends('layouts.app-admin')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('emploi.index')}}">Emplois</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Mettre à jour </a></li>

            </ol>
        </nav>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5 mx-auto">
                    <form method="post" action="{{ route('emploi.update', $emplois->id) }}">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group col-md-12">
                                    <label for="">Emploi</label>
                                    <input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{$emplois->titre}}" />
                                    @error('titre')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Niveau</label>
                                    <select class="form-control @error('niveau') is-invalid @enderror " id="niveau" name="niveau">
                                        <option value="{{$emplois->classe->id_level}}" selected>  </option>
                                        @foreach($niveaux as $niv)
                                            <option value="{{$niv->id}}" {{$niv->id == $emplois->classe->id_level ? 'selected' : ''}}> {{$niv->level}} </option>
                                        @endforeach
                                    </select>
                                    @error('niveau')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Classe</label>
                                    <select class="form-control @error('class') is-invalid @enderror" id="class" name="class">
                                        <option value="{{$emplois->class_id}}" selected> Choisir </option>
                                        @foreach($classes as $class)
                                        <option value="{{$class->id}}" {{$class->id == $emplois->class_id ? 'selected' : ''}}> {{$class->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('class')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                    @enderror
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary"> Ajouter </button>
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
                $('#class').empty();
                $('#class').append('<option value="">--- choisir ---</option>')
                $.ajax({
                    url: "{{ url('admin/Travails/getClasse') }}",
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
                            $('#class').append('<option value="">Aucune Classe disponible</option>')
                        }
                    },
                    error:function(data){
                        $('#class').append('<option value="">Aucun classse à affecter</option>')
                    }
                });
            });
        });
    </script>
@endsection
