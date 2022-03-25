@extends('layouts.app-admin')

@section('content')
    <style>
        .editElev{
            margin-left: 230px;
            margin-top: 55px;
        }
        .btnmodif{
            float: right;
            margin-right: 100px;
            margin-top: -25px;
            margin-bottom: 23px;
            width: 138px;
        }
    </style>

    <div class="container">
        @include('includes.alerts.flash')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('student.index')}}">Elèves Inscrits</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mettre à jour les informations</li>
            </ol>
        </nav>
     <div class="row">
        <div class="card shadow editElev col-md-7 ">
            <form method="post" action="{{ route('student.update', $student->id ) }}">
                @csrf
                <div class="row mb-3 mt-3">
                    <div class="col-6">
                        <label for="nomEleve">Nom </label>
                        <input type="text" class="form-control" name="nomEleve"
                               value="{{ $student->nomEleve }}" />
                    </div>

                    <div class="col-6">
                        <label for="prenomEleve">Prénom </label>
                        <input type="text" class="form-control" name="prenomEleve"
                               value="{{ $student->prenomEleve }}" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label for="gender">gender </label>
                        <select class="form-control" name="gender">
                            <option value="{{ $student->gender }}" selected>
                                {{ $student->gender==0 ? 'Garcon' : 'Fille' }}</option>

                            <option value="garcon"> Garçon </option>
                            <option value="fille"> Fille </option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="niveau">niveau </label>

                        <select class="form-control" id="niveau" name="niveau">
                            <option value="{{$student->niveau}} " selected>  </option>
                            @foreach( $levels as $lev)
                                <option value="{{$lev->id}}"
                                    {{$lev->id == $student->niveau ? 'selected' : ''}}> {{$lev->level}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

            <div class="row">
                <div class="col-6">
                    <label for="classe">classe </label>

                    <select class="form-control" id="classe" name="classe" >
                        <option value="{{$student->class_id}}" selected>  </option>

                        @foreach( $classe->where('id_level', $student->niveau) as $class)
                            <option value="{{$class->id}}"
                                {{$class->id == $student->class_id ? 'selected' : ''}}> {{$class->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


                <button type="submit" class="btn btn-success btn-circle right btnmodif">Modifier</button>


            </form>

        </div>
     </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#niveau").change(function(){
                $value=$(this).val(),
                    console.log($value);
                $('#classe').empty();
                $('#classe').append('<option value="">--- choisir ---</option>')
                $.ajax({
                    url: "{{ url('admin/student/getClasse') }}",
                    data:{"niveau":$value,},
                    method: 'GET',
                    success: function(data) {
                        var count=0;
                        $.each(data,function(k,v){
                            $('#classe').append($('<option>',{value: k, text: v}));
                            count++;
                        });
                        if(count==0){
                            $('#classe').empty();
                            $('#classe').append('<option value="">Aucune Classe disponible</option>')
                        }
                    },
                    error:function(data){
                        $('#classe').append('<option value="">Aucun classse à affecter</option>')
                    }
                });
            });
        });
    </script>
@endsection
