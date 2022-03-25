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

    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{'accueil'}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('convocations.index')}}">Convocations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edition Convocation </li>

            </ol>
        </nav>

        <div class="card-body">


                    <form method="post" action="{{ route('convocations.updateConv', $convocations->id) }}">
                        @csrf
                        <div class="row">
                                 <div class="col-md-8 ">
                                        <div class="card cardEditConv">
                                            <div class="card-body">
                                               <div class="row">
                                                   <div class="col-6">
                                                       <label for=""> Titre </label>
                                                       <input type="text" class="form-control @error('titre_conv') is-invalid @enderror" name="titre_conv" value="{{$convocations->titre_conv}}" />
                                                       @error('titre_conv')
                                                       <span class="invalid-feedback" role="alert">
                                                               <strong>{{ $message }}</strong>
                                                            </span>
                                                       @enderror
                                                   </div>
                                                   <div class="col-6">
                                                       <label for="" >Date d'envoie</label>

                                                           <input id="date_envoie" type="datetime-local" class="form-control  @error('date_envoie') is-invalid @enderror" name="date_envoie" value="{!! $convocations->date_envoie !!}">
                                                           @error('date_envoie')
                                                           <span class="invalid-feedback" role="alert">
                                                               <strong>{{ $message }}</strong>
                                                            </span>
                                                           @enderror

                                                    </div>
                                                </div>

                                                    <div class="form-group">
                                                        <label for="">Description </label>
                                                        <textarea  id="myarea" class="form-control @error('description') is-invalid @enderror" name="description"  rows="3" >{{$convocations->description}}  </textarea>
                                                        @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                               <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                     </div>


                                                </div>
                                         </div>
                                 </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <div class="col">
                                        <div class="card pp">
                                            <div class="card-body">
                                                <div class="form-group col-md-12">
                                                    <label for="">Niveau</label>
                                                    <select class="form-control "  id="niveau" name="niveau">
                                                        <option value="" selected> Choisir </option>
                                                        @foreach($niveaux as $niv)
                                                            <option value="{{$niv->id}}" {{$niv->id == $students->niveau ? 'selected' : ''}} > {{$niv->level}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Classe</label>
                                                    <select class="form-control " id="class" name="class">
                                                        <option value="" selected> </option>

                                                        <option value="" > </option>
                                                    </select>

                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="">Elève</label>
                                                    <select class="form-control "  id="elev" name="elev">
                                                        <option value="{{$convocations->student_id}}" selected>  </option>
                                                        <option value=""   >  </option>
                                                    </select>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>

                                 </div>
                                <button type="submit" class="btn btn-primary pos">Modifier</button>

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
                        $('#class').append('<option value="">Aucun classe affecter</option>')
                    }
                });
            });
        });
    </script>


@endsection
