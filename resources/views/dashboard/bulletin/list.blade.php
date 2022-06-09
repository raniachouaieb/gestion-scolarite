@if(count($eleves)==0)

    <div class="row">

        <div class="col-md-4  text-center">

            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRgVp4HDtEzLPoatIt2fsvLeioLgrS6A2j6Fw&usqp=CAU" />



        </div>

        <div class="col-md-8">

            <h3>{{__("No data available")}} </h3>
            <hr>
            <p>{{__("There doesn't seem to be any data to display in the level and class you selected")}}</p>
        </div>

    </div>

@endif


@foreach($eleves as $eleve)
    <?php $bulletin = \App\Models\Bulletin::Where('trimestre',$trimestre)->Where('student_id',$eleve->id)->first(); ?>

    <div class="col-md-3">

        <div class="card task-box"  style=" width: 100%; ">
            <div class="card-body">
            <div style="text-transform: initial;">
                <H4>{{$eleve->nomEleve}} {{$eleve->prenomEleve}}</H4>
            </div>
                {{__('Basic average')}} : @if(isset($bulletin)){{$bulletin->basicmoyenne}}@endif <br>
                {{__('Average')}} : @if(isset($bulletin)){{$bulletin->moyenne}}@endif <br>

                <hr>
                <div class="text-center">
                <a   class="btn btn-success" href="{{ route('bulletin.admin.edit', ['id' => $eleve->id,'trimester'=>$trimestre]) }}">
                    {{__('Edit')}}
</a>
</div>
</div>
</div>
</div>

@endforeach







