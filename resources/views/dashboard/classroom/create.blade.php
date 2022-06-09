@extends('layouts.app-admin')
@section('title', $title)

@section('content')
<style>

</style>
<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('classes.index')}}">Classes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajouter classe</li>
        </ol>
    </nav>


            <div class="card page-body">
                <div class="card-body">
              <form method="post" action="{{ route('classes.store') }}">
              @csrf
                  <div class="row">
                      <div class="col-md-12">
                          <div class="headers-line mt-md" style="color: #ef6f6c;"><i class="fas fa-plus"></i> {{__(' Nouveau classe')}}</div>
                          <hr>
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="">Classe </label>
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"/>
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="">Niveau </label>
                                  <select class="form-control @error('id_level') is-invalid @enderror"  name="id_level">
                                      <option value="" selected> Choisir </option>
                                      @foreach( $niveaux as $niv)
                                          <option value="{{$niv->id}}" > {{$niv->level}} </option>
                                      @endforeach

                                  </select>
                                  @error('id_level')
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
                      <button class="btn btn-primary" type="submit">{{ __('Enregistrer')}}</button>
                  </div>
{{--                  <div class="card">--}}
{{--                     <div class="card-body">--}}
{{--                          <div class="form-group">--}}
{{--                              <div class="col">--}}
{{--                                    <label for="">Classe </label>--}}
{{--                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"/>--}}
{{--                                  @error('name')--}}
{{--                                  <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                  @enderror--}}

{{--                              </div>--}}
{{--                              <div class="col">--}}
{{--                                    <label for="">Niveau </label>--}}
{{--                                    <select class="form-control @error('id_level') is-invalid @enderror"  name="id_level">--}}
{{--                                                    <option value="" selected> Choisir </option>--}}
{{--                                                    @foreach( $niveaux as $niv)--}}
{{--                                                      <option value="{{$niv->id}}" > {{$niv->level}} </option>--}}
{{--                                                    @endforeach--}}

{{--                                    </select>--}}
{{--                                  @error('id_level')--}}
{{--                                  <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                  @enderror--}}
{{--                              </div>--}}

{{--                           </div>--}}


{{--                           <button type="submit" class="btn btn-primary">Ajouter</button>--}}
{{--                      </div>--}}
{{--                  </div>--}}
              </form>
                </div>
            </div>



</div>
@endsection

