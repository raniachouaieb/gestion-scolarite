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
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('modules.index')}}">Modules</a></li>
                <li class="breadcrumb-item active" aria-current="page">création module</li>

            </ol>
        </nav>
        <div class="card page-body">
            <div class="card-body">
                    <form method="post" action="{{ route('modules.storeModule') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="headers-line mt-md" style="color: #ef6f6c;"><i class="fas fa-plus"></i> {{__(' nouveau module')}}</div>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="nom_module"> Module:</label>
                                        <input type="text" class="form-control @error('nom_module') is-invalid @enderror" name="nom_module"/>
                                        @error('nom_module')
                                        <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="coefficient_module">Coefficient </label>
                                        <input type="text" class="form-control @error('coefficient_module') is-invalid @enderror" name="coefficient_module"/>
                                        @error('coefficient_module')
                                        <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Niveau </label>
                                        <select class="form-control @error('niveau_id') is-invalid @enderror"  name="niveau_id">
                                            <option value="" selected> Affecter un niveau </option>
                                            @foreach( $niveaux as $niv)
                                                <option value="{{$niv->id}}" > {{$niv->level}} </option>
                                            @endforeach

                                        </select>
                                        @error('niveau_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"  id="switch1" name="status">
                                            <label class="custom-control-label" for="switch1">Basic Study</label>
                                        </div>
                                    </div>
                                </div>
                            </div>  </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span></span>
                            <button class="btn btn-primary" type="submit">{{ __('Ajouter')}}</button>
                        </div>
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="col">--}}
{{--                                        @csrf--}}
{{--                                        <label for="nom_module"> Module:</label>--}}
{{--                                        <input type="text" class="form-control @error('nom_module') is-invalid @enderror" name="nom_module"/>--}}
{{--                                        @error('nom_module')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                      <strong>{{ $message }}</strong>--}}
{{--                                  </span>--}}
{{--                                        @enderror--}}

{{--                                    </div>--}}
{{--                                    <div class="col">--}}
{{--                                        <label for="coefficient_module">Coefficient </label>--}}
{{--                                        <input type="text" class="form-control @error('coefficient_module') is-invalid @enderror" name="coefficient_module"/>--}}
{{--                                        @error('coefficient_module')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                      <strong>{{ $message }}</strong>--}}
{{--                                  </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col">--}}
{{--                                        <label for="">Niveau </label>--}}
{{--                                        <select class="form-control @error('niveau_id') is-invalid @enderror"  name="niveau_id">--}}
{{--                                            <option value="" selected> Affecter un niveau </option>--}}
{{--                                            @foreach( $niveaux as $niv)--}}
{{--                                                <option value="{{$niv->id}}" > {{$niv->level}} </option>--}}
{{--                                            @endforeach--}}

{{--                                        </select>--}}
{{--                                        @error('niveau_id')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}

{{--                                    <br>--}}

{{--                                    <button type="submit" class="btn btn-primary">Ajouter</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </form>

            </div>
        </div>
    </div>
@endsection
