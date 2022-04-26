@extends('layouts.app-admin')
@section('title', $title)

@section('content')
<style>
    /* Style the form */
    #register {
        background-color: #ffffff;
        margin: 100px auto;
        padding: 40px;
        width: 70%;
        min-width: 300px;
    }

    /* Style the input fields */
    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    /* Mark the active step: */
    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #04AA6D;
    }
</style>
    <div class="container">
                     @include('includes.alerts.flash')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ajouter parent</li>
                    </ol>
                </nav>


            <form id="register" action="">
                <div class="tab">Information père :
                     <hr/>

                                <div class="field">
                                    <label>Nom</label>
                                    <input type="text" placeholder="nom" class="form-control  @error('nomPere') is-invalid @enderror">
                                    @error('nomPere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span></span>
                                </div>
                            <div class="col-5">
                                <div class="field">
                                    <label>Prénom</label>
                                    <input type="text" placeholder="prenom">
                                    <span></span>
                                </div>
                            </div>


                                <div class="field">
                                    <label>profession</label>
                                    <input type="text" placeholder="profession">
                                    <span></span>
                                </div>
                            <div class="col-5">
                                <div class="field">
                                    <label>Télephone</label>
                                    <input type="text" placeholder="telephone">
                                    <span></span>
                                </div>
                            </div>



                 </div>

                <div class="tab">Information mère :
                    <hr/>
                    <div class="row">
                        <div class="col-5">
                            <div class="field">
                                <label>Nom</label>
                                <input type="text" placeholder="nom" class="form-control  @error('nomMere') is-invalid @enderror">
                                @error('nomMere')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span></span>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="field">
                                <label>Prénom</label>
                                <input type="text" placeholder="prenom">
                                <span></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5">
                            <div class="field">
                                <label>profession</label>
                                <input type="text" placeholder="profession">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="field">
                                <label>Télephone</label>
                                <input type="text" placeholder="telephone">
                                <span></span>
                            </div>
                        </div>
                    </div>



                 </div>
                <div class="tab"> Information Communes :
                        <hr />
                    <div class="row">
                        <div class="col-5">
                            <div class="field">
                                <label>Adresse</label>
                                <input type="text" placeholder="adresse">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="field">
                                <label>nombre enfants</label>
                                <input type="number" placeholder="">
                                <span></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5">
                            <div class="field">
                                <label>Email</label>
                                <input type="email" placeholder="email">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="field">
                                <label>Mot de passe</label>
                                <input type="password" placeholder="telephone">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab"> Information Enfant:
                    <hr />
                    <div class="row">
                        <div class="col-5">
                            <div class="field">
                                <label>Nom</label>
                                <input type="text" placeholder="nom">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="field">
                                <label>Prénom</label>
                                <input type="text" placeholder="prenom">
                                <span></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5">
                            <div class="field">
                                <label class="genre">Gender</label>
                            </div>
                            <div class="col-8">
                                <select name="gender" class="form-control">
                                    <option selected>Gender</option>
                                    <option value="garcon" > Garcon </option>
                                    <option value="fille" > Fille </option>
                                </select>
                                <span></span>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="field">
                                <label class="pay">Niveau</label>
                            </div>
                            <div class="col-8">
                                <select class="list-dt" id="niv" name="niveau1" class="form-control @error('niveau') is-invalid @enderror">
                                    <option value="" selected> Niveau </option>
                                    @foreach($niveaux as $niv)
                                        <option value="{{$niv->id}}" > {{$niv->level}}</option>
                                    @endforeach
                                </select>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div class="field">
                                <label class="genre">Date naissance</label>
                                <input type="date" name="birth1" placeholder="Date naissance" class="form-control " />
                                <span></span>

                            </div>

                        </div>

                    </div>

                </div>

                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    </div>
                </div>

                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>

            </form>





    </div>

@endsection
