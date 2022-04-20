@extends('layouts.app-admin')
@section('title', $title)

@section('content')
<style>
    form{
        width: 90%;
        height: 650px;
        margin: auto;
        position: relative;
    }
    .form{
        background: whitesmoke;
        padding: 10px;
        position: absolute;
        width: 80%;
        height: 300px;
        left: 10%;
        top: 100px;
        display: none;
    }
    .form.active{
        display: block;
    }


    .form h3{
        width: 80%;
        margin: 50px auto;
        color: #419fe1;
        display: flex;
        align-items: center;
    }
    label{
        display: block;
        padding: 20px;
        font-size: 18px;
        color: #666;
    }
    input{
        width: 96%;
        padding: 8px;
        border: 1px solid #ccc;
        margin-left: 20px;
        border-radius: 3px;
        outline: none;
        font-size: 16px;
    }
    .field>span{
        margin-left: 20px;
        display: block;
        font-style: italic;
        color: red;
    }
    button{
        margin: 20px;
        padding: 8px 20px;
        width: 100px;
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 4px;
        background: linear-gradient( 45deg, #419fe1, cyan);
        color: whitesmoke;
        float: left;
        font-weight: bold;
        position: relative;
        top: 85%;
        left: 10%;
    }
    button:nth-of-type(1){
        display: none;
    }
    .page-indicator{
        height: 50px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        bottom: 10%;
    }
    em{
        display: block;
        width: 30px;
        height: 30px;
        border-radius: 30px;
        background: #ccc;
        margin: 0 10px;
    }
    em.cur-page{
        background: linear-gradient( 45deg, royalblue, cyan);
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

        <section class="cover">
            <form action="">
                <div class="form active">

                    <h3>Information père</h3>
                        <hr/>
                        <div class="row">
                            <div class="col-5">
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
                <div class="form">
                        <h3>Information mere</h3>
                        <hr/>
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
                <div class="form">
                        <h3>Information commune</h3>
                        <hr/>
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
                <div class="form">
                    <h3>Information enfant</h3>
                    <hr/>
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
                <button>Previous</button>
                <button>Next</button>

                <div class="page-indicator">


                </div>
            </form>
        </section>
    </div>
    <script>
        let form, div, button, indicate, curPage, emn;
        form = document.querySelector('form');
        div = document.getElementsByClassName('form')
        button = document.getElementsByTagName('button');
        indicate = document.querySelector('.page-indicator');
        curPage = 0;
        emn = indicate.getElementsByTagName('em');


        window.onload = createIndicator;
        form.onsubmit =()=>{return false;}

        function createIndicator(){
            for(let i=0; i<div.length; i++){
                const em = document.createElement('em');
                em.id = i;
                if (i==0) {em.className = 'cur-page'}
                indicate.appendChild(em);
            }
        }

        button[1].onclick =()=>{validate();} ;
        button[0].onclick = ()=>{
            if (curPage > 0){curPage --;}
            if (curPage < 1) {button[0].style.display = 'none';}
            if (curPage < div.length-1) {button[1].textContent = 'Next';}
            dispayPage(curPage);
            activeIndicator(curPage);
        }

        function validate(){
            const activePage = document.querySelector('.active')
            const field = activePage.getElementsByClassName('field');
            let inputFirst = field[0].children[1];
            let inputLast = field[1].children[1];
            if (inputFirst.value != '' && inputLast.value != ''){
                curPage++;
                button[0].style.display = 'block';
                if (curPage > div.length-2) {button[1].textContent = 'Sign Up';}
                if (curPage >= div.length) {
                    form.onsubmit =()=>{return true;}
                }
                dispayPage(curPage);
                activeIndicator(curPage);
            }
            if (inputFirst.value == '') {hide(inputFirst);}
            if (inputLast.value == '') {hide(inputLast);}
        }
        function dispayPage(page) {
            for(let i of div){
                i.classList.remove('active');
            }
            div[page].classList.add('active');
        }

        function hide(input){
            input.nextElementSibling.textContent = "This field is empty";
            setTimeout(()=>{
                input.nextElementSibling.textContent = "";
            }, 2000);
        }
        function activeIndicator(page){
            for(let i of emn){
                 i.classList.remove('cur-page');
            }
            emn[page].classList.add('cur-page');

        }
    </script>
@endsection
