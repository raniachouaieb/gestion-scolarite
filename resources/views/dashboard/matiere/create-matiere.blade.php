@extends('layouts.app-admin')

@section('title', $title)
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('matieres.index')}}">Matières</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ajouter matière</li>

            </ol>
        </nav>
        <div class="card page-body">
            <div class="card-body">
                        <form method="post" action="{{ route('matieres.storeMatiere') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="headers-line mt-md" style="color: #ef6f6c;"><i class="fas fa-plus"></i> {{__(' nouveau matière')}}</div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="nom"> Nom Matière:</label>
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{old('nom')}}"/>
                                            @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="coeff">Coefficient </label>
                                            <input type="text" class="form-control @error('coeff') is-invalid @enderror" name="coeff" value="{{old('coeff')}}"/>
                                            @error('coeff')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="module">Niveau </label>
                                            <select class="form-control @error('niveau') is-invalid @enderror" id="niveau" name="niveau" value="{{old('niveau')}}">
                                                <option value="" selected> Selectionner niveau </option>
                                                @foreach( $niveaux as $niveau)
                                                    <option value="{{$niveau->id}}" > {{$niveau->level}} </option>
                                                @endforeach

                                            </select>
                                            @error('niveau')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="module">Module </label>
                                            <select class="form-control @error('module') is-invalid @enderror" id="modul" name="modul" value="{{old('modul')}}">
                                                <option value="" selected> Choisir module </option>
                                                <option value="" > </option>
                                            </select>
                                            @error('module')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>  </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span></span>
                                <button class="btn btn-primary" type="submit">{{ __('Ajouter')}}</button>
                            </div>


                        </form>
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
                            $('#modul').append('<option value="">Aucun moudle disponible</option>')
                        }
                    },
                    error:function(data){
                        $('#modul').append('<option value="">Aucun module affecter</option>')
                    }
                });
            });
        });
    </script>
@endsection
