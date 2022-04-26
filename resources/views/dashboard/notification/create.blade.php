@extends('layouts.app-admin')

@section('title', $title)
@section('content')


    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Envoyer notification</li>

            </ol>
        </nav>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-8" style="margin: 47px;margin-left: 147px;">
                <div class="card material-card">
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="">
                            @csrf


                            <div class="form-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="card-title color"><i class="fa fa-paper-plane"></i> Envoyer notification</h5>
                                        <hr />
                                        <div class="center" >
                                            <div class="row">
                                                <div class="col-md-7" style="margin-left: 131px">

                                                    <div class="mb-3">
                                                        <label for="" >Titre</label>
                                                        <input  type="text" class="form-control  @error('titre') is-invalid @enderror" name="titre">
                                                        @error('titre')
                                                        <span class="invalid-feedback" role="alert">
                                                                               <strong>{{ $message }}</strong>
                                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7" style="margin-left: 131px">
                                                    <div class=" mb-3">
                                                        <label for="">Message </label>
                                                        <textarea  name="message" class="form-control  @error('message') is-invalid @enderror" ></textarea>
                                                        @error('message')
                                                        <span class="invalid-feedback" role="alert">
                                                               <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-outline-danger taf px-4" style="margin-left: 440px;">Envoyer</button>

                            </div>


                        </form>




                    </div>



                </div>
            </div>


        </div>
    </div>









@endsection
