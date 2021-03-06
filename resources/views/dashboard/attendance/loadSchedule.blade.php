<form action="{{Route('attendance.store')}}" method="post">
    @csrf
{{--   <input type="hidden" name="level_id" value="{{$level_id}}"/>--}}
    <input type="hidden" name="classroom_id" id="classroomName" value="{{$classroom_id}}"/>

    <div class="row" style=" text-align: center; ">
        <div class="col-4">
            <div class="form-check mb-3">
                <input class="form-check-input  " type="radio" name="trimestre" value="1" id="formRadios1" checked="">
                <label class="form-check-label" for="formRadios1">
                    {{__("1 ere trimestre")}}
                </label>
            </div>
        </div>
        <div class="col-4">

            <div class="form-check">
                <input class="form-check-input  " type="radio" name="trimestre" value="2" id="formRadios2">
                <label class="form-check-label" for="formRadios2">
                    {{__("2 ème trimestre")}}
                </label>
            </div>
        </div>
        <div class="col-4">
            <div class="form-check">
                <input class="form-check-input  " type="radio" name="trimestre" value="3" id="formRadios3">
                <label class="form-check-label" for="formRadios3">
                    {{__("3 ème trimestre")}}
                </label>
            </div>
        </div>


    </div>

{{--    <hr width="50%">--}}
    <input type="hidden" name="emploi_id" value="{{$emploi_id}}"/>
    <table class="table table-hover" id="dynamic-table">
        <thead>
        <tr>
            <th></th>
            @foreach($output as $seance)

                <th class="text-center">{{$seance['from']}} - {{$seance['to']}}</th>

            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>
                    {{$student->nomEleve}} {{$student->prenomEleve}}
                    <input type="hidden" name="student[{{$student->id}}][student_id]" value="{{$student->id}}">

                </td>
                @foreach($output as $key=>$seance)
                    <?php $rowAtt = App\Models\Attendance::where('student_id', $student->id)->where('semester', $trimester)->where('heure_deb', $seance['from'])->where('date', $date)->first();?>

                    <td>
                        <?php $id = $key;?>
                        @if(isset($rowAtt->status))
                            @if($rowAtt->status==0)
                                    <center><a class="btn-clicked btn btn-success"
                                               id="status[{{$student->id}}][{{$seance['from']}}]"
                                               data-toggle="modal" data-target="#exampleModal{{$student->id}}sc{{$key}}"
                                               data-id="{{$student->id}}" data-start="{{$seance['from']}}"
                                               data-end="{{$seance['to']}}"
                                               data-ende="{{$key}}" data-key="sc{{$key}}" data-counter="{{$key}}"
                                               data-name="{{$student->nomEleve}}  {{$student->prenomEleve}}"><p
                                                style="margin-bottom: 0;" id="etat{{$student->id}}">
                                                Present <i class="fa fa-check" aria-hidden="true"></i></p></a></center>
                                @elseif($rowAtt->status==1)
                                    <center><a class="btn-clicked btn btn-success red"
                                               id="status[{{$student->id}}][{{$seance['from']}}]"
                                               data-toggle="modal" data-target="#exampleModal{{$student->id}}sc{{$key}}"
                                               data-id="{{$student->id}}" data-start="{{$seance['from']}}"
                                               data-end="{{$seance['to']}}"
                                               data-ende="{{$key}}" data-key="sc{{$key}}" data-counter="{{$key}}"
                                               data-name="{{$student->nomEleve}}  {{$student->prenomEleve}}"><p
                                                style="margin-bottom: 0;" id="etat{{$student->id}}">
                                                Absent <i class="fa fa-times" aria-hidden="true"></i></p></a></center>
                                @elseif($rowAtt->status==2)
                                    <center><a class="btn-clicked btn btn-success late"
                                               id="status[{{$student->id}}][{{$seance['from']}}]"
                                               data-toggle="modal" data-target="#exampleModal{{$student->id}}sc{{$key}}"
                                               data-id="{{$student->id}}" data-start="{{$seance['from']}}"
                                               data-end="{{$seance['to']}}"
                                               data-ende="{{$key}}" data-key="sc{{$key}}" data-counter="{{$key}}"
                                               data-name="{{$student->nomEleve}}  {{$student->prenomEleve}}"><p
                                                style="margin-bottom: 0;" id="etat{{$student->id}}">
                                                Late <i class="fa fa-clock" aria-hidden="true"></i></p></a></center>
                                @endif
                            @else
                                <center><a class="btn-clicked btn btn-success"
                                           id="status[{{$student->id}}][{{$seance['from']}}]"
                                           data-toggle="modal" data-target="#exampleModal{{$student->id}}sc{{$key}}"
                                           data-id="{{$student->id}}" data-start="{{$seance['from']}}"
                                           data-end="{{$seance['to']}}"
                                           data-ende="{{$key}}" data-key="sc{{$key}}" data-counter="{{$key}}"
                                           data-name="{{$student->nomEleve}}  {{$student->prenomEleve}}"><p
                                            style="margin-bottom: 0;" id="etat{{$student->id}}">
                                            Present <i class="fa fa-check" aria-hidden="true"></i></p></a></center>
                            @endif
                    </td>
                    </td>

                @endforeach
            </tr>

            <input type="hidden" name="count" value="">

        @endforeach
        </tbody>
    </table>
    @foreach($students as $student)
    <!-- Modal -->
        @for($i=0;$i<=$count-1;$i++)
            <?php $rowAtt = App\Models\Attendance::where('student_id', $student->id)->where('semester', $trimester)->where('heure_deb', $output[$i]['from'])->where('date', $date)->first();?>

                <div class="modal fade" id="exampleModal{{$student->id}}sc{{$i}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{$student->id}}sc{{$i}}">Status</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="student[{{$student->id}}][from][sc{{$i}}]"
                                       name="student[{{$student->id}}][status][{{$i}}][from]" value="{{$output[$i]['from']}}">
                                <input type="hidden" id="student[{{$student->id}}][to][sc{{$i}}]"
                                       name="student[{{$student->id}}][status][{{$i}}][to]" value="{{$output[$i]['to']}}">
                                <div>
                                    <label id="time{{$student->id}}sc{{$i}}"> </label>
                                </div>
                                <table id="tableSpacing">


                                    <tr>

                                        <td><label for="present">Present</label></td>
                                        <td><input type="radio" name="student[{{$student->id}}][status][{{$i}}][etat]"
                                                   class="student[{{$student->id}}][status]"
                                                   id="present"
                                                   value="0"
                                                   {{isset($rowAtt->status)&& $rowAtt->status==0 ?? 'checked'}} checked></td>

                                    </tr>
                                    <tr>

                                        <td><label for="absent">Absent</label></td>
                                        <td><input type="radio" name="student[{{$student->id}}][status][{{$i}}][etat]"
                                                   id="absent"
                                                   class="student[{{$student->id}}][status]"
                                                   value="1" {{isset($rowAtt->status)&& $rowAtt->status==1 ? 'checked':''}}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="late">Late</label></td>
                                        <td><input type="radio" name="student[{{$student->id}}][status][{{$i}}][etat]" id="late"
                                                   class="student[{{$student->id}}][status]"
                                                   value="2" {{isset($rowAtt->status)&& $rowAtt->status==2 ? 'checked':''}}>
                                        </td>
                                    </tr>
                                </table>

                                <div>
                                    <label for="raison"> Raison : </label>
                                    <textarea class="form-control" name="student[{{$student->id}}][status][{{$i}}][raison]"
                                              id="raison"
                                              rows="3">{{isset($rowAtt->raison)?$rowAtt->raison:''}}</textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="validate[{{$student->id}}]" data-dismiss="modal"
                                        class="btn-validate{{$student->id}} btn btn-primary">Validate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        @endfor
    @endforeach

    <div class="d-flex justify-content-between">
        <span></span>
        <button id="send_form" class="btn btn-primary" type="submit">Enregistrer</button>
    </div>
</form>
<script>
    var triggerTabList = [].slice.call(document.querySelectorAll('.nav-tabs a'))

    triggerTabList.forEach(function (triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl)

        triggerEl.addEventListener('click', function (event) {
            event.preventDefault()
            tabTrigger.show()
            $("#portalStudent").hide()
        })

    })


    /*$('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })*/


    $(".btn-clicked").click(function () {

        var trimestre = $('input[name=trimestre]:checked').val();

        $student_id = $(this).data("id");
        $student_nameStudent = $(this).data("name");
        $h_deb = $(this).data("start");
        $i = $(this).data("key");
        $h_fin = $(this).data("end");
        $counter = $(this).data("counter");
        $keye = $(this).data("ende");

        console.log('studentid', $student_nameStudent);
        console.log('h_deb', $h_deb);
        console.log('h_fin', $h_fin);
        console.log('trimestre', trimestre);

        $position = document.getElementById('exampleModalLabel' + $student_id + $i);

        $position.innerHTML = $student_nameStudent;
        $posTime = document.getElementById('time' +$student_id+$i);
        $posTime.innerHTML = 'Séance de ' + $h_deb + ' à ' + $h_fin;
        console.log('byid', $posTime);
        //document.getElementById('time' + $student_id).innerHTML = 'Séance de ' + $h_deb + ' à ' + $h_fin;

        $(".btn-validate" + $student_id).click(function () {
            let $statusAtt, $position;

            $pos = document.getElementById('status[' + $student_id + '][' + $h_deb + ']');
            $statusAtt = document.getElementById('validate[' + $student_id + ']');
            console.log('rr', $pos);

            $position2 = document.getElementById('etat' + $student_id);

            console.log($position2);
            $seance = $h_deb.substring(0, 2);
            console.log($seance);

            var ele = $("input[name=" + $.escapeSelector('student[' + $student_id + '][status][' + $counter + '][etat]') + "]:checked").val()
            console.log('val', $counter);

            if (ele == 0) {
                $pos.innerHTML = 'Present ' + '<i class="fa fa-check" aria-hidden="true"></i>';
                $pos.classList.remove("red");
                $pos.classList.remove("late");
            } else if (ele == 1) {
                $pos.innerHTML = 'Absent ' + '<i class="fa fa-times" aria-hidden="true"></i>';
                $pos.classList.remove("late");
                $pos.classList.add("red");

            } else if (ele == 2) {
                $pos.innerHTML = 'Late ' + '<i class="fa fa-clock" aria-hidden="true"></i>';
                $pos.classList.remove("red");
                $pos.classList.add("late");
            }

        });

        /*if(classroom_id && level_id && matiere_id && trimestre){
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
                url:  '/'+classroom_id+'/'+level_id+'/'+trimestre+'/'+matiere_id,
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
                                $('#send_form').html('Sending..');
                                $.ajax({
                                    url: '' ,
                                    type: "POST",
                                    data: $('#note-form').serialize(),
                                    success: function( response ) {
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
        }*/

    });

    // function getStatus(student_id) {
    //
    //     let $statusAtt, $position;
    //
    //     $statusAtt = document.getElementById('validate');
    //
    //     $position = document.getElementById('etat' + student_id);
    //     console.log($position);
    //     //$position.innerHTML='gg';
    //     var ele = document.getElementsByTagName('input');
    //
    //     $statusAtt.addEventListener("click", function (e) {
    //         for (i = 0; i < ele.length; i++) {
    //
    //             if (ele[i].type = "radio") {
    //
    //
    //                 if (ele[i].checked)
    //                     $position.innerHTML = ele[i].value;
    //                 // setAttribute("value", ele[i].value);
    //             }
    //         }
    //
    //     });
    //
    // }
</script>
