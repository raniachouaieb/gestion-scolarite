@extends('layouts.app-admin')

@section('title', $title)
@section('content')
    <style>
        .pos {
            float: right;
            margin-right: 138px;
            margin-top: 27px;
            width: 153px;
        }
        .addCard{

            margin-left: 55px;
            margin-top: 25px;

        }
        .imgcardadd{
            margin-top: 100px;
            margin-right: 15px;
        }
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('menu.index')}}">Cantine</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ajouter un nouveau menu</li>

            </ol>
        </nav>


                    <form method="post" action="{{ route('menu.storeMenu') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card addCard">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-6">
                                                <label for=""  class="col-md-8">Date</label>
                                                <div class="col">
                                                    <input id="date" type="date" class="form-control  @error('date') is-invalid @enderror" name="date">
                                                    @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                    <label for="" class="col-md-8">Jour</label>
                                                <div class="col">
                                                  <select class="form-control @error('jour') is-invalid @enderror"  name="jour">
                                                    <option value="" selected>  Selectionner un jour  </option>
                                                    <option value="Lundi" > Lundi </option>
                                                    <option value="Mardi" > Mardi </option>
                                                    <option value="Mercredi" > Mercredi </option>
                                                    <option value="jeudi" > jeudi </option>
                                                    <option value="vendredi" > vendredi </option>
                                                    <option value="samedi" > samedi </option>

                                                  </select>
                                                    @error('jour')
                                                    <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>


                                            </div>
                                        </div>


                                        <div class="form-group">
                                                    <label for="" class="col-md-6 ">Menu</label>
                                                        <div class="col">
                                                        <textarea id="myarea" name="menu" class="form-control tinymce-editor @error('menu') is-invalid @enderror"></textarea>
                                                            @error('menu')
                                                            <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                            @enderror
                                                        </div>
                                        </div>
                                     </div>
                                </div>
                             </div>
                            <div class="col-md-5">
                                <div class="card imgcardadd">
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="">Selectionner image</label>
                                            <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror"/>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pos">Ajouter</button>

                            </div>

                         </div>
                    </form>




    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('.show_images').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Images`,
                text: "Select an image",
                icon: "",
                buttons: true,
                dangerMode: true,
            }),
            function() {
                $.ajax({
                    type: "GET",
                    url: "{{url('public/uploads/menus/')}}",
                    data: {id: id},
                    success: function (data) {
                        //
                    }
                });
            }

        });

    </script>

@endsection
