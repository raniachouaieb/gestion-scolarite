@extends('layouts.app-admin')
{{-- Page title --}}

@section('title',$title)

@section('content')

    <div class="container">
        <div class="card "  id="trimestre">
            <div class="card-title">
                <div class="caption font-green-haze">
                    <div class="text-center">
                    <h4>{{__(' Trimestres')}}</h4>
                    </div>  <hr width="20%">
                 </div>
             </div>
             <div class="card-body "style="position: relative;">
                 <div class="row" style=" text-align: center; ">
                     <div class="col-4">
                         <div class="form-check mb-3">
                             <input class="form-check-input" type="radio" name="trimestre" value="1" id="formRadios1" checked="">
                             <label class="form-check-label" for="formRadios1">
                                 {{__("1 ère  trimestre")}}
                             </label>
                         </div>
                     </div>
                     <div class="col-4">

                         <div class="form-check">
                             <input class="form-check-input" type="radio" name="trimestre" value="2" id="formRadios2">
                             <label class="form-check-label" for="formRadios2">
                                 {{__("2 ème trimestre")}}
                             </label>
                         </div>
                     </div>
                     <div class="col-4">
                         <div class="form-check">
                             <input class="form-check-input" type="radio" name="trimestre" value="3" id="formRadios3">
                             <label class="form-check-label" for="formRadios3">
                                 {{__("3 ème trimestre")}}
                             </label>
                         </div>
                     </div>


                 </div>
             </div>
         </div>
     <div class="card" style="margin-top: 15px">
         <div class="card-body page-body">
             <div class="text-center">
                 <h4  >
                    {{__("Niveaux")}}
                 </h4>
                 <hr width="20%">
             </div>

             <div class="form-body">
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
         </div>
     </div>

     <div class="card" id="portal" >
         <div class="card-body "style="position: relative;">
             <h2  class="text-center" >
                 {{__(' List of students')}} - <span id="classe"></span>
            </h2>
            <hr />
            <div class="row"  id="portalbody" ></div>
        </div>
    </div>
    </div>
@endsection


@section('scripts')
    <script>


        $("#portal").hide();
        $("button").click(function() {
          //  $("#class").html(niveaunom + ' / '+ classenom);
            $("#portal").hide();
            $level=$(this).data('level');
            $classe=$(this).val();
            console.log($level);
            console.log(($classe));
            var trimestre= $('input[name=trimestre]:checked').val();
            $.ajax({
                url:  '{{url('admin/bulletin/list/')}}'+'/'+$classe+'/'+$level+'/'+trimestre,
                type: "get",

                success: function (data) {
                    $("#portal").show();
                    $("#portalbody").html(data);
                    $('html,body').animate({
                        scrollTop: $("#portal" ).offset().top
                    }, 'slow');
                }
            })
        });
    </script>

@stop

