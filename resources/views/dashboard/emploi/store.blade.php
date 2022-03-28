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
            </ol>
        </nav>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5 mx-auto">
                    <form method="post" action="{{ route('emploi.store') }}">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group col-md-12">
                                    <label for="">Niveau</label>
                                    <select class="form-control " id="niveau" name="niveau">
                                        <option value="" selected> Choisir </option>
                                        @foreach($niveaux as $niv)
                                            <option value="{{$niv->id}} " > {{$niv->level}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Classe</label>
                                    <select class="form-control " id="class" name="class">
                                        <option value="" selected> Choisir </option>
                                        <option value=""> </option>
                                    </select>
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
                    url: "{{ url('admin/emploi/getClasse') }}",
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
