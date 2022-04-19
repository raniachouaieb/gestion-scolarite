@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .position {
            float: right;
            margin-top: 50px;
            margin-right: 35px;
        }
        .niv{
            margin-left: 214px;
        }
        .tabModule{
            margin-top: 100px;
        }

        .colrtrash{
            color: red;
            margin-left: 7px;
        }
    </style>
    <div class="container">

    <!--@include('includes.alerts.flash')  -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Classes</li>
            </ol>
        </nav>
        <div class="row  position mb-5">
            <a  class="btn btn-primary position" href="{{ route('classes.add')}}"><i class="fas fa-plus"></i> Ajouter</a>
        </div>

        <div class="row niv">
            @foreach($niveaux as $niv)

                <div class="row">
                    <div class="form-group col-24 " id="niveau">
                        <button type="button" class=" btn btn-outline-danger  mr-2 ml-3 mt-2" value="{{$niv->id}}" id="button" >{{$niv->level}}</button>

                    </div>
                </div>

            @endforeach

        </div>

        <div class=" tabModule mb-4" id="tabClassHide">
            <div class="table-responsive">
                <div id="class_filter">

                </div>

            </div>
        </div>

        <script type="text/javascript">
            $("#tabClassHide").hide();
            $("button").click(function() {
                $button = $(this).val();
                console.log($button);
                $("#tabClassHide").hide();
                $.ajax({
                    url: "{{ Route('classes.classByLevel') }}" ,
                    data:{"niveau":$(this).val()},
                    method: 'GET',
                    success: function(classByLevel) {
                        $('#class_filter').html(classByLevel);
                        $("#tabClassHide").show();
                        console.log("classByLevel");
                        document.getElementById("tabHide").scrollIntoView( {behavior: "smooth" })
                    }
                });
            });
            //  $('#tabHide').hide();
        </script>


@endsection
