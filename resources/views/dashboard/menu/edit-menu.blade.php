@extends('layouts.app-admin')

@section('title', $title)
@section('content')
    <style>
        .pos {
            float: right;
            margin-right: 92px;
            margin-top: 27px;
            width: 153px;
        }
        .editcard{
            margin-left: 55px;
            margin-top: 25px;
        }
        .imgcard{
            margin-top: 100px;
            margin-right: 15px;
        }
    </style>
    <div class="container">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('menu.index')}}">Cantine</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modifier le menu</li>

            </ol>
         </nav>


                <form method="post" action="{{ route('menu.updateMenu', $menu->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$menu->id}}" name="id_menu" id="id_menu"/>
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="card editcard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for=""  class="col-md-8">Date</label>
                                            <div class="col">
                                                <input id="date" type="date" class="form-control  @error('date') is-invalid @enderror" name="date" value="{{$menu->date}}">
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
                                                <input id="jour" type="text" name="jour"  value="{{$menu->jour}}"class="form-control @error('jour') is-invalid @enderror">
                                                @error('jour')
                                                <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="" class="col-md-6" >Menu</label>
                                        <div class="col">
                                            <textarea id="myarea" name="menu">{{$menu->menu}}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                             </div>

                         </div>
                        <div class="col-md-4">
                            <div class="card imgcard">
                                <div class="card-body">
                                    <div class="form-group col-md-12 ">
                                        <label for="">Selectionner image</label>
                                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror"">
                                        <img src="{{asset('uploads/menus/'.$menu->image)}}"  width="90px" alt="image">
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                            <button type="submit" class="btn btn-primary pos">Modifier</button>

                        </div>

                     </div>


                 </form>




     </div>

@endsection
