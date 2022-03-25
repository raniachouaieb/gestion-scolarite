@extends('layouts.app-admin')

@section('content')

    <div class="container">
        @include('includes.alerts.flash')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Elèves Inscrits</li>
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


        <div class="card shadow mb-4" id="tabEleveHide">
            <div class="table-responsive">
                <div id="eleve_filter">

                </div>

            </div>
        </div>

        <script type="text/javascript">
            $("#tabEleveHide").hide();
            $("button").click(function() {
                $button = $(this).val();
                console.log($button);
                $("#tabEleveHide").hide();
                $.ajax({
                    url: "{{ Route('student.eleveByClass') }}" ,
                    data:{"class":$(this).val()},
                    method: 'GET',
                    success: function(eleveByClass) {
                        $('#eleve_filter').html(eleveByClass);
                        $("#tabEleveHide").show();
                        console.log("eleveByClass");
                        //bech yahbet lel partie eli n7eb 3leha
                        document.getElementById("tabHide").scrollIntoView( {behavior: "smooth" })
                    }
                });
            });
            //  $('#tabHide').hide();
        </script>

@endsection
