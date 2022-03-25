
<style>
    .countParent{
        float: left;
        margin-left: 5px;
        margin-top: 1px;
        border: 1px ridge;
        box-shadow: 1px 1px 2px indianred;
        border-radius: 2px 4px 4px;
        padding: 1px 4px;
    }

</style>
<div class="container">
<div class="row "><h6><span class="countParent mr-2">{{$parentByClasse->count()}}</span>Parent Inscrits </h6></div>
        <div class="parentTab mb-4" id="list">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>

                    <tr>
                        <th> Père</th>
                        <th>Télephhone </th>
                        <th> Mère </th>
                        <th>Télephone </th>
                        <th>Email</th>
                        <th>Enfant(s)</th>
                        <th colspan="1">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($parentByClasse as $par)
                        <tr>
                            <td>{{$par->nomPere}} {{$par->prenomPere}}</td>
                            <td>{{$par->telPere}}</td>
                            <td>{{$par->nomMere}} {{$par->prenomMere}}</td>
                            <td>{{$par->telMere}}</td>
                            <td>{{$par->email}}</td>
                            <td> @foreach($par->students as $elev)
                                    <ul>
                                        <li>
                                       @if($elev->gender == 1) <span class="badge badge-danger">{{$elev->nomEleve }} {{$elev->prenomEleve }}</span>
                                        @else <span class="badge badge-info">{{$elev->nomEleve }} {{$elev->prenomEleve }}</span>
                                        @endif
                                        </li>
                                    </ul>
                                @endforeach
                            </td>
                            <td><a href="{{ route('isncri.edit', $par->id)}}" ><i class="fas fa-pen fa-sm"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

<div class="d-flex justify-content-center">
    {!! $parentByClasse->links() !!}
</div>
</div>





