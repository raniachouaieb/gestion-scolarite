@extends('layouts.app-admin')
@section('title',$title)

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
                <li class="breadcrumb-item active" aria-current="page">Observation</li>
            </ol>
        </nav>
        <div class=" card shadow mb-5 cardNiveClass">
            <div class="row">
                @foreach($levels as $niv)

                    <div class="col-4">
                        <a type="" class=" col-5 ml-3 mt-2" id="niveau{{$loop->index}}" data-id="{{$niv->id}}" data-target="#classNiveau{{ $niv->id}}">{{$niv->level}}</a>
                        <div class="row">
                            <div class="btn-group ml-4 mb-1  " id="class{{ $niv->id}}" >
                                @foreach($niv->classes as $listClass)
                                    <button type="button" class="btn btn-outline-danger mt-2" data-level="{{ $niv->id}}" value="{{$listClass->id}}" id="button">{{$listClass->name}}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

        </div>


        <div class="card shadow mb-4" id="tabHide">

            <div class="table-responsive">
                <div id="note_filter">


                </div>

            </div>
        </div>
        <div class="card" id="portal2">
            <div class="card-body" >
                <div class="d-flex align-items-center justify-content-between">
                    <h4>
                        <span id="classe2"></span>
                    </h4>
                    <h6><span id="classe3"></span></h6>
                </div>
                <div class="card-title">

                </div>
                <div   id="portalbody2" ></div>
            </div>
        </div>


</div>

@endsection
        @section('scripts')
            <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
            <script type="text/javascript">
                $("#tabHide").hide();
                $("#portal2").hide();
                $("button").click(function() {
                    $button = $(this).val();
                    console.log($button);
                    $level_id = $(this).data("level");
                    $("#tabHide").hide();
                    $("#portal2").hide();
                    $.ajax({
                        url: "{{ route('observation.admin.loadmodules') }}/"+$button+'/'+$level_id ,
                        //data:{"class":$(this).val()},
                        method: 'GET',
                        success: function(data) {
                            $('#note_filter').html(data);
                            $("#tabHide").show();
                            console.log("data");
                            //bech yahbet lel partie eli n7eb 3leha
                            document.getElementById("tabHide").scrollIntoView( {behavior: "smooth" })
                            $( ".btn-check2" ).click(function() {

                                var trimestre=$('input[name=trimestre]:checked').val();
                                var matiere_id=$('input[name=matiere_id]:checked').val();
                                var level_id=$('input[name=level_id]').val();
                                var classroom_id=$('input[name=classroom_id]').val();
                                if(classroom_id && level_id && matiere_id && trimestre){
                                    var titleCard="";
                                    var idVal = $('input[name=matiere_id]:checked').attr("id");
                                    titleCard+=$("label[for='"+idVal+"']").text();
                                    idVal =$('input[name=matiere_id]:checked').closest('.tab-pane.active').attr("id");
                                    titleCard+=' / '+$("a[href='#module3'] span:last-child").text();
                                    $("#classe2").html(titleCard);
                                    idVal = $('input[name=trimestre]:checked').attr("id");
                                    $("#classe3").html($("label[for='"+idVal+"']").text());
                                    $("#portal2").hide();
                                    $.ajax({
                                        url:  '{{url('admin/observation/loadobservation')}}/'+classroom_id+'/'+level_id+'/'+trimestre+'/'+matiere_id,
                                        type: "get",

                                        success: function (data) {
                                            $("#portal2").show();

                                            $("#portalbody2").html(data);

                                            $('html,body').animate({
                                                scrollTop: $("#portalbody2" ).offset().top
                                            }, 'slow');
                                            if ($("#note-form").length > 0) {
                                                $("#note-form").validate({

                                                    rules: {
                                                        title: {
                                                            required: true,
                                                            maxlength: 50
                                                        },
                                                        body: {
                                                            required: true,
                                                            maxlength: 250
                                                        }
                                                    },
                                                    messages: {
                                                        title: {
                                                            required: "Please Enter Name",
                                                            maxlength: "Your last name maxlength should be 50 characters long."
                                                        },
                                                        body: {
                                                            required: "Please Enter Body",
                                                            maxlength: "Your last body maxlength should be 250 characters long."
                                                        },
                                                    },
                                                    submitHandler: function(form) {
                                                        $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                        console.log('111');
                                                        $('#send_form').html('Sending..');
                                                        $.ajax({
                                                            url: '{{route('observation.admin.store') }}' ,
                                                            type: "POST",
                                                            data: $('#note-form').serialize(),
                                                            success: function( response ) {
                                                                console.log('222')
                                                                $('#send_form').html('Submit');
                                                                $('#res_message').show();
                                                                $('#msg_div').show();
                                                                $('#res_message').html(response.msg);
                                                                $('html,body').animate({
                                                                    scrollTop: $("#portal2" ).offset().top
                                                                }, 'slow');
                                                                $("#portal2").hide();
                                                                $('#msg_div').removeClass('d-none');

                                                            }
                                                        });
                                                    }
                                                })
                                            }
                                        }
                                    })
                                }

                            });
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
