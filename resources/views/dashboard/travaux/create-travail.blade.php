@extends('layouts.app-admin')

@section('title', $title)
@section('content')
<style>
    .cardaddtravail{
        margin-top: 15px;
    }
    .pos{
        float: right;
        margin-right: 100px;
        margin-top: -11px;
        width: 138px;
    }
    .taf{
        margin-left: 889px;
        width: 121px;
    }
    .drag-area{
        border: 2px dashed #6e707e;
        height: 205px;
        width: 692px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin-left: 20px;
    }
    .drag-area.active{
        border: 2px solid #1b1e21;


    }
    .drag-area .icon{
        font-size: 30px;
        font-weight: 500;
    }
    .drag-area .header{
        font-size: 20px;
        font-weight: 500;
    }
    .drag-area span{
        font-size: 20px;
        font-weight: 500;
        margin: 10px 0 15px 0;
    }
    .drag-area .button{
        font-size: 20px;
        font-weight: 500;
        color: #5256ad;
        cursor: pointer;

    }
    .drag-area img{
        width: 40%;
        height: 85%;
        object-fit: cover;
    }
    .color{
        color: #34ce57;
    }
</style>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('travails.index')}}">Travaux à faire</a></li>
            <li class="breadcrumb-item active" aria-current="page">Déposer un travail</li>

        </ol>
    </nav>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12">
            <div class="card material-card">
                <div class="card-body">
                <form method="post" action="{{ route('travails.storeTravail') }}" enctype="multipart/form-data">
                    @csrf


                                        <div class="form-body">

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5 class="card-title color"><i class="fa fa-list-alt"></i> Travail à faire</h5>
                                                    <hr />
                                                    <div class="row">
                                                        <div class="col-4">
                                                    <div class="mb-3">
                                                        <label for="" >Date Depot</label>
                                                        <input id="date_depot" type="date" class="form-control  @error('date_depot') is-invalid @enderror" name="date_depot">
                                                        @error('date_depot')
                                                        <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                        </span>
                                                        @enderror
                                                    </div>
                                                        </div>
                                                        <div class="col-4"><label for="" >Date Limite</label>
                                                            <input id="date_limite" type="date" class="form-control  @error('date_limite') is-invalid @enderror" name="date_limite">
                                                            @error('date_limite')
                                                            <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                        </span>
                                                            @enderror</div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-4">
                                                    <h5 class="card-title">About Product</h5>
                                                    <hr />
                                                    <div class="mb-3">
                                                        <label for="">Niveau</label>
                                                        <select class="form-control " id="niveau" name="niveau">
                                                            <option value="" selected> Choisir </option>
                                                            @foreach($niveaux as $niv)
                                                                <option value="{{$niv->id}}" > {{$niv->level}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                             </div>
                                            <!--/row-->
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                        <label for=""> Titre </label>
                                                        <input type="text" class="form-control @error('titre_travail') is-invalid @enderror" name="titre_travail"/>
                                                        @error('titre_travail')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="">Classe</label>
                                                        <select class="form-control " id="class" name="class">
                                                            <option value="" selected> Choisir </option>
                                                            <option value=""> </option>
                                                        </select>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                        <label for="">Détail </label>
                                                        <textarea  name="detail_travail" class="form-control  @error('detail_travail') is-invalid @enderror" ></textarea>
                                                        @error('detail_travail')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="">Matiere</label>
                                                            <select class="form-control "  name="matiere">
                                                                <option value="" selected> Choisir </option>
                                                                @foreach($matieres as $mat)
                                                                    <option value="{{$mat->id}}"> {{$mat->nom}}</option>
                                                                @endforeach
                                                            </select>


                                                     </div>
                                                <!--/span-->
                                                </div>

                                                <div class="drag-area">
                                                    <div class="icon"><i class="fa fa-cloud-download-alt"></i></div>
                                                    <div class="header">Drag & drop to upload</div>
                                                    <span class="header"> OR <span class="button">Browse file</span></span>
                                                    <!--<button id="file">Browse file</button>-->
                                                    <input type="file"  name="image" hidden>
                                                </div>

                                            </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-outline-success taf px-4">Ajouter</button>

                    </div>


                </form>




                                         </div>



                  </div>
            </div>


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
                url: "{{ url('admin/Travails/getClasse') }}",
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
                        $('#class').append('<option value="">Aucune Classe disponible</option>')
                    }
                },
                error:function(data){
                    $('#class').append('<option value="">Aucun classse à affecter</option>')
                }
            });
        });
    });
</script>
    <script>
        const dropArea = document.querySelector(".drag-area");
        dragText = dropArea.querySelector(".header");
        button = dropArea.querySelector(".button");
        input = dropArea.querySelector("input");

        button.onclick = ()=>{
            input.click();
        }
        input.addEventListener('change',function(){
            file = this.files[0];
            dropArea.classList.add('active');
            displayFiles();
        })

        let file;
        //if user drag file over dropArea
         dropArea.addEventListener("dragover", (event)=>{
             event.preventDefault();
            // console.log("file is over dropArea");
             dropArea.classList.add("active");
             dragText.textContent = "release to upload file";
         });

        //if user leave file from dropArea
        dropArea.addEventListener("dragleave", (event)=>{
            //console.log("file is outside from dropArea");
            dropArea.classList.remove("active");
            dragText.textContent= "Drag & drop o upload";
        });

        //if user drop file on dropArea
        dropArea.addEventListener("drop", (event)=>{
            event.preventDefault();
            file = event.dataTransfer.files[0];
            displayFiles();


        });
        function displayFiles(){
            let fileType = file.type;

            let validExtensions = ["image/jpeg", "image/png", "image/jpg", "application/pdf" ];
            if(validExtensions.includes(fileType)){
                let fileReader = new FileReader(); //creating new fileReader object
                fileReader.onload = ()=>{
                    //remplace par le nom du fichier et non pas par le Base64
                   // let fileURL = file.name;
                    let fileURL = fileReader.result;//passing user file source in fileURl variable
                    console.log(fileURL);

                    let imgTag = `<img name="image" src="${fileURL}" alt=""><input value="${fileURL}" type="hidden" name="image">`;
                    dropArea.innerHTML = imgTag; //add created img in dropArea

                }
                fileReader.readAsDataURL(file);
            }else{
                console.log("this is not image ");
                dropArea.classList.remove("active");
            }
        }

    </script>




@endsection
