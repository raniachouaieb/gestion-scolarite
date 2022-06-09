@extends('layouts.app-admin')
{{-- Page title --}}
@section('title',$title)
@section('name',$name)

{{-- Page content --}}
@section('content')

    <div class="card">
        <div class="card-body">
            <h1 class="text-center">{{ __('All Sudents')}}</h1>
            <div class="form-body">
                    <div class="row">
                        @foreach($levels as $niv)




                            <div class="col-4">
                                <a type="" class=" col-5 ml-3 mt-2" id="niveau{{$loop->index}}" data-id="{{$niv->id}}" data-target="#classNiveau{{ $niv->id}}">{{$niv->level}}</a>
                                <div class="row">
                                    <div class="btn-group ml-4 mb-1  " id="class{{ $niv->id}}" >
                                        @foreach($niv->classes as $listClass)
                                            <button type="button" class="btn btn-outline-danger mt-2" data-level="{{ $niv->id}}" data-name="{{$niv->level}}" data-nameclass="{{$listClass->name}}" value="{{$listClass->id}}" id="button">{{$listClass->name}}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>


            </div>
        </div>
    </div>

    <div class="card" id="tabHide">
        <div class="card-body" >

            <div class="card-title">
                <div class="caption font-green-haze">
                    {{__(" Liste des modules")}} - <span id="classe"></span>
                 </div>
             </div>
             <div   id="module_filter" ></div>
         </div>
     </div>

     <div class="row">
         <div class="col-md-12">
             <div class="alert alert-success d-none" id="msg_div">
                 <span id="res_message"></span>
             </div>
         </div>
     </div>
     <div class="card" id="portal2">
         <div class="card-body" >

             <div class="card-title">
                 <div class="d-flex align-items-center justify-content-between">
                     <h4>
                         <span id="classe2"></span>
                     </h4>
                     <h6><span id="classe3"></span></h6>
                 </div>
             </div>
             <div   id="portalbody2" ></div>
         </div>
     </div>
 @stop



 {{-- page level scripts --}}
@section('scripts')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script>

            $("#tabHide").hide();
            $("button").click(function() {
            $button = $(this).val();
            console.log($button);
            $level_id = $(this).data("level");
            $level_name = $(this).data("name");
                $class_name = $(this).data("nameclass");
            $("#tabHide").hide();
            $.ajax({
            url: "{{ url('admin/teacherRemarks/loadModules') }}/"+$button+'/'+$level_id ,
            //data:{"class":$(this).val()},
            method: 'GET',
            success: function(data) {
            $('#module_filter').html(data);
            $("#tabHide").show();
                $("#classe").html($level_name + ' / '+ $class_name);


                console.log("data");
            //bech yahbet lel partie eli n7eb 3leha
            document.getElementById("tabHide").scrollIntoView( {behavior: "smooth" })
                $(".btn-check2").click(function() {
                    $("#portal2").hide();
                    var trimestre = $('input[name=trimestre]:checked').val();
                    var module_id = $('input[name=module_id]:checked').val();
                    var level_id = $('input[name=level_id]').val();
                    var classroom_id = $('input[name=classroom_id]').val();
                    if (classroom_id && level_id && module_id && trimestre) {
                        var titleCard = "";
                        var idVal = $('input[name=module_id]:checked').attr("id");
                        titleCard += $("label[for='" + idVal + "']").text();
                        $("#classe2").html(titleCard);
                        idVal = $('input[name=trimestre]:checked').attr("id");
                        $("#classe3").html($("label[for='" + idVal + "']").text());
                        $("#portal2").hide();
                        $.ajax({
                            url: '{{route('teacherRemarks.admin.loadNotes')}}/' + classroom_id + '/' + level_id + '/' + trimestre + '/' + module_id,
                            type: "get",

                            success: function (data) {
                                $("#portal2").show();
                                $("#portalbody2").html(data);
                                $('html,body').animate({
                                    scrollTop: $("#portalbody2").offset().top
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
                                        submitHandler: function (form) {
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $('#send_form').html('Sending..');
                                            $.ajax({
                                                url: '{{route('teacherRemarks.admin.store', ['id'=>'-1']) }}',
                                                type: "POST",
                                                data: $('#note-form').serialize(),
                                                success: function (response) {
                                                    $('#send_form').html('Submit');
                                                    $('#res_message').show();
                                                    $('#msg_div').show();
                                                    $('#res_message').html(response.msg);
                                                    $('html,body').animate({
                                                        scrollTop: $("#portal2").offset().top
                                                    }, 'slow');
                                                    $('#msg_div').removeClass('d-none');
                                                    $("#portal2").hide();
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





    </script>


@stop

