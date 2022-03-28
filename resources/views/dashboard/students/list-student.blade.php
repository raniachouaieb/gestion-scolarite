<style>
    .countEleve{
        float: left;
        margin-left: 5px;
        margin-top: 1px;
        border: 1px ridge;
        box-shadow: 1px 1px 2px indianred;
        border-radius: 2px 4px 4px;
        padding: 1px 4px;
    }
    .search{
        margin-left: 400px;
    }
    .pencil{
        margin-left: 18px;
    }
</style>
<form  method="get" action="{{route('student.search')}}">
    @csrf
    <br>
    <div class="container">
        <div class="row">
            <div class="form-group row search">
                <div class="col-sm-9">
                    <input class="form-control mr-sm-2" name="query" id="query" type="text" placeholder="chercher">
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit"> <i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="container">
<div class="row mb-2"><h6><span class="countEleve mr-2">{{$eleveByClass->count()}}</span>Eleve Inscrits </h6></div>


<div class=" listEleve mb-4">
    <div class="table-responsive">
        <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th> Elève</th>
                                            <th>Classe</th>
                                            <th>Niveau </th>
                                            <th> Gender </th>
                                            <th colspan="1">Action</th>
                                        </tr>
                                    </thead>



                                    <tbody>
                                    @foreach($eleveByClass as $getstudent)
                                        <tr>
                                            <td>{{$getstudent->nomEleve}} {{$getstudent->prenomEleve}}</td>

                                            <td> @foreach($class as $classe) @if($classe->id == $getstudent->classe) {{$classe->name}} @endif   @endforeach</td>

                                            <td>@foreach($niveaux as $level) @if($level->id == $getstudent->niveau){{$level->level}} @endif @endforeach</td>
                                            <td>{{$getstudent->gender==0 ? 'Garcon' : 'Fille'}}</td>
                                            <td><a href="{{route('student.edit', $getstudent->id)}}" ><i class="fas fa-pen fa-sm pencil"></i></a></td>



                                        </tr>
                                        @endforeach



                                    </tbody>
                                </table>
        {{$eleveByClass->links()}}
                            </div>
                        </div>

</div>

