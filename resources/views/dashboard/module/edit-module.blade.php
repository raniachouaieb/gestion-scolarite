@extends('layouts.app-admin')
@section('title', $title)
@section('content')
    <style>
        .btnModif {
            margin-left: 90px;
        }
    </style>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('modules.index')}}">Modules</a></li>
            <li class="breadcrumb-item">Modifier module</li>

        </ol>
    </nav>
    <div class="container">
        <div class="card page-body">
            <div class="card-body">
                        <form method="POST" action="{{ route('modules.update', $module->id ) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="headers-line mt-md" style="color: #ef6f6c;"><i class="fa fa-marker"></i>{{__(' Modification module')}}</div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="nomModule">Module:</label>
                                            <input type="text" class="form-control" name="nomModule" value="{{ $module->nom_module }}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="coeffModule">Coefficient:</label>
                                            <input type="text" class="form-control" name="coeffModule" value="{{ $module->coefficient_module }}"/>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Niveau </label>
                                            <select class="form-control @error('niveau_id') is-invalid @enderror"  name="niveau_id">
                                                <option value="{{$module->niveau_id}}" selected>  </option>
                                                @foreach( $niveaux as $niv)
                                                    <option value="{{$niv->id}}" {{$niv->id == $module->niveau_id ? 'selected' : ''}} > {{$niv->level}} </option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>
                                </div>  </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span></span>
                                <button class="btn btn-primary" type="submit">{{ __('Modifier')}}</button>
                            </div>
{{--                                 <div class="card">--}}
{{--                                     <div class="card-body">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="nomModule">Module:</label>--}}
{{--                                            <input type="text" class="form-control" name="nomModule" value="{{ $module->nom_module }}"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="coeffModule">Coefficient:</label>--}}
{{--                                            <input type="text" class="form-control" name="coeffModule" value="{{ $module->coefficient_module }}"/>--}}
{{--                                        </div>--}}

{{--                                         <div class="form-group">--}}
{{--                                             <label for="">Niveau </label>--}}
{{--                                             <select class="form-control @error('niveau_id') is-invalid @enderror"  name="niveau_id">--}}
{{--                                                 <option value="{{$module->niveau_id}}" selected>  </option>--}}
{{--                                                 @foreach( $niveaux as $niv)--}}
{{--                                                     <option value="{{$niv->id}}" {{$niv->id == $module->niveau_id ? 'selected' : ''}} > {{$niv->level}} </option>--}}
{{--                                                 @endforeach--}}

{{--                                             </select>--}}
{{--                                         </div>--}}


{{--                                             <button type="submit" class="btn btn-outline-primary btnModif">Modifier</button>--}}
{{--                                      </div>--}}
{{--                                  </div>--}}
                        </form>

             </div>
        </div>
    </div>
</div>
@endsection
