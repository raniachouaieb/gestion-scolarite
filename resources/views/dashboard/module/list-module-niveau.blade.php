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
            margin-left: 41px;
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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modules</li>
            </ol>
        </nav>
        <div class="row  position mb-5">
            <a  class="btn btn-primary position" href="{{ route('modules.add')}}"><i class="fas fa-plus"></i></a>
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

        <div class="card shadow tabModule mb-4" id="tabModuleHide">
            <div class="table-responsive">
                <div id="module_filter">

                </div>

            </div>
        </div>

        <script type="text/javascript">
            $("#tabModuleHide").hide();
            $("button").click(function() {
                $button = $(this).val();
                console.log($button);
                $("#tabModuleHide").hide();
                $.ajax({
                    url: "{{ Route('modules.moduleByLevel') }}" ,
                    data:{"niveau":$(this).val()},
                    method: 'GET',
                    success: function(moduleByLevel) {
                        $('#module_filter').html(moduleByLevel);
                        $("#tabModuleHide").show();
                        console.log("moduleByLevel");
                        document.getElementById("tabHide").scrollIntoView( {behavior: "smooth" })
                    }
                });
            });
            //  $('#tabHide').hide();
        </script>


@endsection
