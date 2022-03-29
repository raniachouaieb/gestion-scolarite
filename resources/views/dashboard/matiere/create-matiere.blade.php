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
            Ajouter une matière
        </div>
        <div class="card-body">

                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form method="post" action="{{ route('matieres.storeMatiere') }}">
                            <div class="card">
                                <div class="card-body">
                                   <div class="form-group">
                                        <div class="col">
                                            @csrf
                                            <label for="nom"> Nom Matière:</label>
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"/>
                                            @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="coeff">Coefficient </label>
                                            <input type="text" class="form-control @error('coeff') is-invalid @enderror" name="coeff"/>
                                            @error('coeff')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                       <div class="col">
                                           <label for="module">Niveau </label>
                                           <select class="form-control @error('niveau') is-invalid @enderror" id="niveau" name="niveau">
                                               <option value="" selected> Selectionner niveau </option>
                                               @foreach( $niveaux as $niveau)
                                                   <option value="{{$niveau->id}}" > {{$niveau->level}} </option>
                                               @endforeach

                                           </select>
                                       </div>


                                       <div class="col">
                                           <label for="module">Module </label>
                                           <select class="form-control @error('modul') is-invalid @enderror" id="modul" name="modul">
                                               <option value="" selected> Choisir module </option>
                                                   <option value="" > </option>
                                           </select>
                                       </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>

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
