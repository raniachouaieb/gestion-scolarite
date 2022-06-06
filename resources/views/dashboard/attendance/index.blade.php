@extends('layouts.app-admin')

@section('content')
    <style>
        .cardNiveClass{
            padding: 18px;
        }

    </style>

    <div class="container">
        @include('includes.alerts.flash')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Absences</li>
            </ol>
        </nav>
        <div class=" card shadow mb-5 cardNiveClass">
            <div class="row">
                @foreach($niveaux as $niv)

                    <div class="col-4">
                        <a type="" class=" col-5 ml-3 mt-2" id="niveau{{$loop->index}}" data-id="{{$niv->id}}" data-target="#classNiveau{{ $niv->id}}">{{$niv->level}}</a>
                        <div class="row">
                            <div class="btn-group ml-4 mb-1  " id="class{{ $niv->id}}" >
                                @foreach($niv->classes as $listClass)
                                    <button type="button" class="btn btn-outline-danger mt-2" data-level="{{ $niv->id}}" data-names="{{$niv->level}}/{{$listClass->name}}" value="{{$listClass->id}}" id="button">{{$listClass->name}}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

        </div>


        <div class="card shadow mb-4" id="tabHide">

            <div class="card-body " >
                <div class="d-flex align-items-center justify-content-between">
                    <h4>
                        {{__("List of attendances")}} - <span id="classe"></span>
                    </h4>
                    <h6>Current date : {{$date}}</h6>
                </div>
                <hr>
                <div id="student_filter">





                </div>

            </div>
        </div>

        <script type="text/javascript">
            $("#tabHide").hide();
            $("button").click(function() {
                $button = $(this).val();
                console.log($button);
                $level_id = $(this).data("level");
                $nameNivClass = $(this).data("names");

                $("#tabHide").hide();
                $.ajax({
                    url: "{{ url('admin/attendance/loadSchedule') }}/"+$button ,
                    //data:{"class":$(this).val()},
                    method: 'GET',
                    success: function(data) {
                        $('#student_filter').html(data);
                        $("#tabHide").show();
                      document.getElementById('classe').innerHTML=$nameNivClass;
                        //bech yahbet lel partie eli n7eb 3leha
                        document.getElementById("tabHide").scrollIntoView( {behavior: "smooth" })
                    }
                });
            });
            //  $('#tabHide').hide();

            function DoDeleted($id) {
                $("#myModalId").val($id);
                $('#myModal').modal('show');
            }


        </script>

@endsection
