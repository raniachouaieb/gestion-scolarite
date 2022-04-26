@extends('layouts.app-admin')
@section('title', $title)

@section('content')
<style>
    h1{
        font-weight:400;
        padding-top:0;
        margin-top:0;
        font-family: 'Roboto Slab', serif;
    }

    #svg_form_time {
        height: 15px;
        max-width: 80%;
        margin: 40px auto 20px;
        display: block;
    }

    #svg_form_time circle,
    #svg_form_time rect {
        fill: white;
    }

    .button {
        background: rgb(237, 40, 70);
        border-radius: 5px;
        padding: 15px 25px;
        display: inline-block;
        margin: 10px;
        font-weight: bold;
        color: white;
        cursor: pointer;
        box-shadow:0px 2px 5px rgb(0,0,0,0.5);
        /*margin-left: 599px;*/
    }

    .disabled {
        display:none;
    }

    section {
        padding: 50px ;
        max-width: 489px;
        margin: 30px auto;
        background:white;
        background:rgba(255,255,255,0.9);
        backdrop-filter:blur(10px);
        box-shadow:0px 2px 10px rgba(0,0,0,0.3);
        border-radius:5px;
        transition:transform 0.2s ease-in-out;
    }


    input {
        width: 100%;
        margin: 7px 0px;
        display: inline-block;
        padding: 12px 25px;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid lightgrey;
        font-size: 1em;
        font-family:inherit;
        background:white;
    }

    p{
        text-align:justify;
        margin-top:0;
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


           <!-- <form id="register" action="">
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

                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>

            </form>-->
        <div id="svg_wrap"></div>

        <h1>Enregistrer parent</h1>
        <form method="post" action="{{route('store')}}">
            @csrf
        <section>
            <p>Information Père</p>
            <input type="text" name="nomPere" placeholder="nom" class="form-control  @error('nomPere') is-invalid @enderror">
            @error('nomPere')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <input type="text" name="prenomPere" placeholder="prenom">
            <input type="text" name="professionPere" placeholder="profession" />
            <input type="text" name="telPere" placeholder="Télephone" />
        </section>

        <section>
            <p>Information Mère</p>
            <input type="text" name="nomMere" placeholder="nom" class="form-control  @error('nomMere') is-invalid @enderror">
            @error('nomMere')
            <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" name="prenomMere" placeholder="prenom">
            <input type="text" name="professionMere" placeholder="profession" />
            <input type="text" name="telMere" placeholder="Télephone" />
        </section>

        <section>
            <p>Information Communes</p>
            <input type="text" name="adresse" placeholder="adresse">
            <input type="number" name="nbEnfants"  placeholder="nombre nefants">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="mot de passe">
        </section>

        <section>
            <p>Information Enfant</p>
            <input type="text" name= "nomEleve"  placeholder="nom">
            <input type="text" name="prenomEleve" placeholder="prenom">
            <select name="gender" class="form-control">
                <option selected>Gender</option>
                <option value="garcon" > Garcon </option>
                <option value="fille" > Fille </option>
            </select>
            <select  id="niv" name="niveau" class="form-control @error('niveau') is-invalid @enderror">
                <option value="" selected> Niveau </option>
                @foreach($niveaux as $niv)
                    <option value="{{$niv->id}}" > {{$niv->level}}</option>
                @endforeach
            </select>

            <input type="date" name="birth" placeholder="Date naissance" class="form-control " />
        </section>

        <section>
            <p>General condtitions</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.riatur.</p>
        </section>

        <div class="button" id="prev">&larr; Previous</div>
        <div class="button" id="next">Next &rarr;</div>
        <button class="button" type="submit" id="submit">Agree and send application</button>



        </form>

    </div>
    <script>
        $( document ).ready(function() {
            var base_color = "rgb(230,230,230)";
            var active_color = "rgb(237, 40, 70)";



            var child = 1;
            var length = $("section").length - 1;
            $("#prev").addClass("disabled");
            $("#submit").addClass("disabled");

            $("section").not("section:nth-of-type(1)").hide();
            $("section").not("section:nth-of-type(1)").css('transform','translateX(100px)');

            var svgWidth = length * 200 + 24;
            $("#svg_wrap").html(
                '<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' +
                svgWidth +
                ' 24" xml:space="preserve"></svg>'
            );

            function makeSVG(tag, attrs) {
                var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
                for (var k in attrs) el.setAttribute(k, attrs[k]);
                return el;
            }

            for (i = 0; i < length; i++) {
                var positionX = 12 + i * 200;
                var rect = makeSVG("rect", { x: positionX, y: 9, width: 200, height: 6 });
                document.getElementById("svg_form_time").appendChild(rect);
                // <g><rect x="12" y="9" width="200" height="6"></rect></g>'
                var circle = makeSVG("circle", {
                    cx: positionX,
                    cy: 12,
                    r: 12,
                    width: positionX,
                    height: 6
                });
                document.getElementById("svg_form_time").appendChild(circle);
            }

            var circle = makeSVG("circle", {
                cx: positionX + 200,
                cy: 12,
                r: 12,
                width: positionX,
                height: 6
            });
            document.getElementById("svg_form_time").appendChild(circle);

            $('#svg_form_time rect').css('fill',base_color);
            $('#svg_form_time circle').css('fill',base_color);
            $("circle:nth-of-type(1)").css("fill", active_color);


            $(".button").click(function () {
                $("#svg_form_time rect").css("fill", active_color);
                $("#svg_form_time circle").css("fill", active_color);
                var id = $(this).attr("id");
                if (id == "next") {
                    $("#prev").removeClass("disabled");
                    if (child >= length) {
                        $(this).addClass("disabled");
                        $('#submit').removeClass("disabled");
                    }
                    if (child <= length) {
                        child++;
                    }
                } else if (id == "prev") {
                    $("#next").removeClass("disabled");
                    $('#submit').addClass("disabled");
                    if (child <= 2) {
                        $(this).addClass("disabled");
                    }
                    if (child > 1) {
                        child--;
                    }
                }
                var circle_child = child + 1;
                $("#svg_form_time rect:nth-of-type(n + " + child + ")").css(
                    "fill",
                    base_color
                );
                $("#svg_form_time circle:nth-of-type(n + " + circle_child + ")").css(
                    "fill",
                    base_color
                );
                var currentSection = $("section:nth-of-type(" + child + ")");
                currentSection.fadeIn();
                currentSection.css('transform','translateX(0)');
                currentSection.prevAll('section').css('transform','translateX(-100px)');
                currentSection.nextAll('section').css('transform','translateX(100px)');
                $('section').not(currentSection).hide();
            });

        });
    </script>

@endsection
