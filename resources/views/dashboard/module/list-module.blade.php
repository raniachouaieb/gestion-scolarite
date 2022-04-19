<style>
    .countModule{
        float: left;
        margin-left: 25px;
        margin-top: 2px;
        border: 1px ridge;
        box-shadow: 1px 1px 2px indianred;
        border-radius: 2px 4px 4px;
        padding: 1px 4px;
    }
    .table-responsive table thead tr{color: #ffffff;
        font-family: 'Nunito', sans-serif;
        font-weight: inherit}
</style>

<div class="container">
    <!--@include('includes.alerts.flash')  -->



        <div class=" mb-6 ">
            <div class="row mb-2 module"><h6><span class="countModule mr-2">{{$moduleByLevel->count()}}</span>Modules </h6></div>

            <div class="table-responsive">

                <table class="table table-striped">
                    <thead class="bg-primary">
            <tr>
                <td class="col-6">Nom</td>
                <td class="col-3">Coefficient</td>
                <td class="col-2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($moduleByLevel as $modul)
                <tr>
                    <td class="col-6"><a href="{{route('modules.show', $modul->id)}}" class="btn btn-info" data-toggle="collapse" data-target="#demo{{ $modul->id}}">{{$modul->nom_module}}</a></td>
                    <td class="col-3">{{$modul->coefficient_module}}</td>
                    <td class="col-2"><a href="{{route('modules.edit', $modul->id)}}"  type="submit" ><i class="fas fa-pen fa-sm"></i></a>


                        <form action="{{route('modules.destroy', $modul->id)}}" method="post" class="d-inline" >
                            @csrf

                            <a type="submit" class=" show_confirm" data-toggle="tooltip" title='Delete'><i class="fas fa-trash fa-sm colrtrash"></i></a>



                        </form>
                    </td>
                </tr>
                <div  id="demo{{ $modul->id}}" class="collapse" >
                    <ul>
                        @foreach($modul->matieres as $listMat)

                            <li>{{$listMat->nom}}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            </tbody>

        </table>


            </div>

        </div>


</div>
    <script type="text/javascript">

        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

    </script>



