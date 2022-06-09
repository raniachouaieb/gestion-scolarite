@if(count($modules)==0)
    <div class="row">
        <div class="col-md-4  text-center">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRgVp4HDtEzLPoatIt2fsvLeioLgrS6A2j6Fw&usqp=CAU" />

        </div>
        <div class="col-md-8">
            <h3>{{__("No data available")}}</h3>
            <hr>
            <p>{{__("There doesn't seem to be any data to display in the level and class you selected")}} </p>
        </div>
    </div>
@else
    <br>
    <input type="hidden" name="level_id" value="{{$level_id}}" />
    <input type="hidden" name="classroom_id" value="{{$classroom_id}}" />
    <div class="row" style=" text-align: center; ">
        <div class="col-4">
            <div class="form-check mb-3">
                <input class="form-check-input btn-check2" type="radio" name="trimestre" value="1" id="formRadios1" checked="">
                <label class="form-check-label" for="formRadios1">
                    {{__("1 st  trimestre")}}
                </label>
            </div>
        </div>
        <div class="col-4">

            <div class="form-check">
                <input class="form-check-input btn-check2" type="radio" name="trimestre" value="2" id="formRadios2">
                <label class="form-check-label" for="formRadios2">
                    {{__("2 nd trimestre")}}
                </label>
            </div>
        </div>
        <div class="col-4">
            <div class="form-check">
                <input class="form-check-input btn-check2" type="radio" name="trimestre" value="3" id="formRadios3">
                <label class="form-check-label" for="formRadios3">
                    {{__("3 nd trimestre")}}
                </label>
            </div>
        </div>


    </div>
    @if (is_array($modules) || is_object($modules))
        <div class="nav nav-tabs col-12" role="tablist">

            @foreach($modules as $item )
                <input  hidden type="radio" class="btn-check btn-check2" name="module_id" value="{{$item->id}}" id="module{{$item->id}}" autocomplete="off">
                <label class="btn btn-outline-success" for="module{{$item->id}}">{{$item->nom_module}}</label>



            @endforeach

        </div>
    @endif
@endif

<script>

</script>
