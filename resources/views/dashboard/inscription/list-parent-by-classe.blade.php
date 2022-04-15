@extends('layouts.app-admin')

@section('content')

    <div class="container">
        @include('includes.alerts.flash')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Liste Parents Inscrits</li>
            </ol>
        </nav>
        <div class=" card shadow mb-5">
            <div class="row">
                @foreach($niveaux as $niv)

                    <div class="col-4">
                    <a type="" class=" col-5 ml-3 mt-2" data-target="#classNiveau{{ $niv->id}}">{{$niv->level}}</a>
                    <div class="row">
                        <div class="btn-group ml-4 mb-1  " id="class{{ $niv->id}}" >
                            @foreach($niv->classes as $listClass)
                                <button type="button" class="btn btn-outline-danger mt-2" value="{{$listClass->id}}" id="button">{{$listClass->name}}</button>
                            @endforeach
                        </div>
                    </div>
                    </div>

                @endforeach
            </div>

        </div>


    <div class="card shadow mb-4" id="tabHide">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary  pt-4 pb-3 box">
                <h6 class="text-white text-capitalize ps-3">Parents Inscrit</h6>
            </div>
        </div>
        <div class="table-responsive">
        <div id="parent_filter">

        </div>

        </div>
    </div>

        <script type="text/javascript">
           $("#tabHide").hide();
            $("button").click(function() {
                $button = $(this).val();
                console.log($button);
                $("#tabHide").hide();
                $.ajax({
                    url: "{{ Route('inscri.parentByClass') }}" ,
                    data:{"class":$(this).val()},
                    method: 'GET',
                    success: function(parentByClasse) {
                        $('#parent_filter').html(parentByClasse);
                        $("#tabHide").show();
                        console.log("parentByClasse");
                        //bech yahbet lel partie eli n7eb 3leha
                        document.getElementById("tabHide").scrollIntoView( {behavior: "smooth" })
                    }
                });
            });
            //  $('#tabHide').hide();
        </script>
@endsection
