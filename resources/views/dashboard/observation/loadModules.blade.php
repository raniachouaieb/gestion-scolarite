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
                <input class="form-check-input  " type="radio" name="trimestre" value="1" id="formRadios1" checked="">
                <label class="form-check-label" for="formRadios1">
                    {{__("1 st  trimestre")}}
                </label>
            </div>
        </div>
        <div class="col-4">

            <div class="form-check">
                <input class="form-check-input  " type="radio" name="trimestre" value="2" id="formRadios2">
                <label class="form-check-label" for="formRadios2">
                    {{__("2 nd trimestre")}}
                </label>
            </div>
        </div>
        <div class="col-4">
            <div class="form-check">
                <input class="form-check-input  " type="radio" name="trimestre" value="3" id="formRadios3">
                <label class="form-check-label" for="formRadios3">
                    {{__("3 nd trimestre")}}
                </label>
            </div>
        </div>


    </div>
    @if (is_array($modules) || is_object($modules))
        <ul class="nav nav-tabs col-12" role="tablist">
            @foreach($modules as $item )
                <li class="nav-item" >
                    <a class="nav-link {{$loop->first ?"active":""}}" data-bs-toggle="tab" href="#module{{$item->id}}" role="tab" aria-selected="{{$loop->first ?"true":"false"}}">
                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-block">  {{$item->nom_module}}</span>
                    </a>
                </li>

            @endforeach

        </ul>


        <div class="tab-content p-3 text-muted col-12">
            @foreach($modules as $item )
                <div class="tab-pane {{$loop->first?"active":""}}" id="module{{$item->id}}" role="tabpanel">
                    <div class="mb-0" style="text-align: center">
                        @foreach($item->matieres as $matiere )
                            <input type="radio" class="btn-check btn-check2" name="matiere_id" value="{{$matiere->id}}" id="matiere{{$matiere->id}}" autocomplete="off">
                            <label class="btn btn-outline-success" for="matiere{{$matiere->id}}">{{$matiere->nom}}</label>
                        @endforeach
                    </div>
                </div>


            @endforeach
        </div>
    @endif
@endif

<script>
    var triggerTabList = [].slice.call(document.querySelectorAll('.nav-tabs a'))

    triggerTabList.forEach(function (triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl)

        triggerEl.addEventListener('click', function (event) {
            event.preventDefault()
            tabTrigger.show()
            $("#portal2").hide()
        })

    })
</script>
