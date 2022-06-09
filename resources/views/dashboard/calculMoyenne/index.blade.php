@extends('layouts.app-admin')
{{-- Page title --}}
@section('title',$title)


@section('content')
    <div class="container">
        @include('includes.alerts.flash')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Calcul Moyenne</li>
            </ol>
        </nav>

    <div class="card page-body">
        <div class="card-body">
            <form action="{{route('calculMoyenne.admin.store') }}" method="post" class="notSendAjax needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="headers-line mt-md" style="color: #ef6f6c;"><i class="fas fa-user-check"></i> {{__(' Details')}}</div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="niveau">niveau </label>

                                <select class="form-control" id="niveau" name="niveau">
                                    <option value=" " >  choisir </option>
                                    @foreach( $levels as $lev)
                                        <option value="{{$lev->id}}"
                                          > {{$lev->level}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="classe">classe </label>

                                <select class="form-control" id="classe" name="classe" >
                                    <option value="" > choisir </option>

                                    @foreach( $classe as $class)
                                        <option value="{{$class->id}}"
                                            > {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="trimester">{{ __('Trimestre')}} </label>
                                <select id="trimester" name="trimester" class="form-control" required="">
                                    <option value="">{{ __(' Choisir ')}} </option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>


                                </select>
                            </div>
                        </div>
                    </div>  </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span></span>
                    <button class="btn btn-primary" type="submit">{{ __('Enregistrer')}}</button>
                </div>
            </form>
        </div>

    </div>
    @if(isset($builletins))
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Elève</th>

                        @if(count($builletins)>0)
                            @foreach($builletins[0]['modules'] as $module)
                                <th scope="col">{{$module['module']}} /  {{$module['moduleCoeff']}}</th>
                            @endforeach
                        @endif
                        <th scope="col">basicmoyenne</th>
                        <th scope="col">Moyenne</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($builletins as $builletin)
                        <tr>
                            <th scope="row">#{{$loop->index+1}}</th>
                            <td>{{$builletin['student']}}</td>

                            @foreach($builletin['modules'] as $module)

                                <td>{{number_format((float)$module['moyenne'], 2, '.', '')}}</td>
                            @endforeach
                            <td>{{number_format((float)$builletin['moyenne'], 2, '.', '')}}</td>
                            <td>{{number_format((float)$builletin['moyenne'], 2, '.', '')}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

@section ('scripts')
    <script>
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
    </script>
    </div>
@endsection
