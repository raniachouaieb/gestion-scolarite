@extends('layouts.app-admin')

@section('title', $title)
@section('content')
    <style>
        .cardedittravail{
            margin-top: 15px;
        }
        .pos{
            float: right;
            margin-right: 100px;
            margin-top: -11px;
            width: 138px;
        }
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('travails.index')}}">Travaux à faire</a></li>
            <li class="breadcrumb-item active" aria-current="page">Déposer un travail</li>

        </ol>
    </nav>
    <div class="container">
        <div class="card-body">

            <form method="post" action="{{ route('travails.updateTravail', $travail->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="card cardedittravail">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" >Date Depot</label>
                                        <input id="date_depot" type="date" class="form-control  @error('date_depot') is-invalid @enderror" name="date_depot" value="{{$travail->date_depot}}">
                                        @error('date_depot')
                                        <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="" >Date Limite</label>
                                        <input id="date_limite" type="date" class="form-control  @error('date_limite') is-invalid @enderror" name="date_limite" value="{{$travail->date_limite}}">
                                        @error('date_limite')
                                        <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                        </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">

                                    <label for=""> Titre </label>
                                    <input type="text" class="form-control @error('titre_travail') is-invalid @enderror" name="titre_travail" value="{{$travail->titre_travail}}"/>
                                    @error('titre_travail')
                                    <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Détail </label>
                                    <textarea  name="detail_travail" class="form-control  @error('detail_travail') is-invalid @enderror" >{{$travail->detail_travail}}</textarea>
                                    @error('detail_travail')
                                    <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>

                                <div class="container">
                                    <div class="row">
                                        <div class="container-fluid">

                                        </div>
                                    </div>

                                </div>

                                <br>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group col-md-12">
                                            <label for="">Niveau</label>
                                            <select class="form-control "  id="niveau" name="niveau">
                                                <option value="{{$travail->class->id_level}}" selected> Choisir </option>
                                                @foreach($niveaux as $niveau)
                                                <option value="{{$niveau->id }}" {{$niveau->id == $travail->class->id_level ? 'selected' : ''}}>{{$niveau->level}}  </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Classe</label>
                                            <select class="form-control " id="class" name="class">
                                                <option value="{{$travail->class_id}}" selected> Choisir </option>
                                                @foreach($classe as $class)
                                                <option value="{{$class->id}}" {{$class->id == $travail->class_id ? 'selected' : ''}}> {{$class->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Matiere</label>
                                            <select class="form-control "  name="matiere">
                                                <option value="{{$travail->matiere_id}}" selected> Choisir </option>
                                                @foreach($matieres as $mat)
                                                    <option value="{{$mat->id}}" {{$mat->id == $travail->matiere_id ? 'selected' : ''}}>{{$mat->nom}}</option>
                                                    @endforeach
                                            </select>
                                        </div>


                                    </div>
                                </div>

                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary pos"> Déposer</button>

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
