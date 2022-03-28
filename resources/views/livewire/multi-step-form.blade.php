<div>
@include('includes.alerts.flash')
<!--form action="{{ route('register') }} " method="post">-->
       <form wire:submit.prevent="register">
        @csrf
        <div>


        @if ($currentStep == 1)
        <div class="step-one">
            <div class="card">
                <div class="card-header bg-secondary text-white">STEP 1/5 - Information Pere</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nom</label>
                                <input type="text"  class="form-control @error('nomPere') is-invalid @enderror" placeholder="Votre nom" wire:model="nomPere" name="nomPere" id="nomPere">
                                @error('nomPere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Prenom</label>
                                <input type="text" class="form-control  @error('prenomPere') is-invalid @enderror" placeholder="Votre prenom"  wire:model="prenomPere">
                                @error('prenomPere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Profession</label>
                                <input type="text" class="form-control  @error('professionPere') is-invalid @enderror" placeholder="Votre profession"  wire:model="professionPere">
                                @error('professionPere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Telephone</label>
                                <input type="phone" class="form-control  @error('telPere') is-invalid @enderror" placeholder="Votre numero du telephone"  wire:model="telPere">
                                @error('telPere')
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
        @endif

        @if ( $currentStep ==2)

        <div class="step-two">
            <div class="card">
                <div class="card-header bg-secondary text-white">STEP 2/5 - Information Mere</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nom</label>
                                <input type="text" class="form-control @error('nomMere') is-invalid @enderror" placeholder="Votre nom"  wire:model="nomMere">
                                @error('nomMere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Prenom</label>
                                <input type="text" class="form-control @error('prenomMere') is-invalid @enderror" placeholder="Votre prenom"  wire:model="prenomMere">
                                @error('prenomMere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Profession</label>
                                <input type="text" class="form-control @error('prenomMere') is-invalid @enderror" placeholder="Votre profession"  wire:model="professionMere">
                                @error('professionMere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Telephone</label>
                                <input type="phone" class="form-control @error('telMere') is-invalid @enderror" placeholder="Votre numero du telephone"  wire:model="telMere">
                                @error('telMere')
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
        @endif

        @if($currentStep ==3)

        <div class="step-three">
            <div class="card">
                <div class="card-header bg-secondary text-white">STEP 3/5 - Informations generales</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombre enfants</label>
                                <input type="number" class="form-control @error('nbEnfants') is-invalid @enderror" placeholder=""  value="1" wire:model="nbEnfants">
                                @error('nbEnfants')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Adresse</label>
                                <input type="text" class="form-control  @error('adresse') is-invalid @enderror" placeholder="Votre adresse"  wire:model="adresse">
                                @error('adresse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Votre email"  wire:model="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Votre mot de passe"  wire:model="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password"  wire:model="password">
                                @error('password')
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
        @endif

        @if($currentStep == 4)

        <div class="input_fields_wrap">

        <div class="step-four">
            <div class="card">
                <div class="card-header bg-secondary text-white">STEP 4/5 - Informations Enfans</div>
                <div id="field">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="">Nom Eleve</label>
                                <input type="text" class="form-control @error('nomEleve') is-invalid @enderror" placeholder="" wire:model="nomEleve" >
                                @error('nomEleve')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Prenom Eleve</label>
                                <input type="text" class="form-control @error('prenomEleve') is-invalid @enderror" placeholder=""  wire:model="prenomEleve">
                                @error('prenomEleve')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                     </div>

                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Niveau</label>
                                <select class="form-control @error('niveau') is-invalid @enderror" wire:model="niveau">
                                    <option value="" selected> Choisir </option>
                                    <option value="1ere année" > 1ere année </option>
                                    <option value="2eme année" >2eme année </option>
                                    <option value="3eme année" > 3eme année</option>
                                    <option value="4eme année" >4eme année </option>
                                    <option value="5eme année" > 5eme année </option>
                                    <option value="6eme année" >  6eme année </option>
                                </select>
                                @error('niveau')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror    </div>


                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="">Genre</label>

                                <select class="form-control @error('gender') is-invalid @enderror"  wire:model="gender">
                                    <option value="" selected> Choisir </option>
                                    <option value="garcon" > Garcon </option>
                                    <option value="fille" > Fille </option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                    </div>

                 </div>

                </div>

                     <div class="form-group">
                        <div class="col-md-4 col-md-offset-8">
                            <button id="add-more" name="add-more" class="btn btn-primary add_field_button">Add More</button>
                        </div>
                   </div>
        </div>


            </div>

        </div>

        </div>

        @endif



        @if($currentStep == 5)

        <div class="step-five">
            <div class="card">


                        <div class="form-group">
                            <label for="" class="d-block">
                                <input type="checkbox" id="terms" wire:model="terms"> Vous devez accepter nos <a href=""> termes et conditions</a>

                             </label>
                             <span class="text-danger">@error('terms'){{ $message }}@enderror</span>

                        </div>

                    </div>





            </div>

        </div>
        @endif


        <div class="action-buttons d-flex justify-content-between bg-white pt-2 pb-2">
        <br>


        @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4 )
        <button type="button" class="btn btn-md btn-secondary" wire:click.prevent="back()">Back</button>
        @endif

        @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3 || $currentStep == 4  )
        <div></div>
        <button type="button" class="btn btn-md btn-success" wire:click="gotonext()">Next</button>
        @endif

        @if ($currentStep == 5)
        <input type="submit">
       <!-- <button type="submit" class="btn btn-md btn-primary">submit</button>-->

        @endif
        </div>
</div>
    </form>




</div>



