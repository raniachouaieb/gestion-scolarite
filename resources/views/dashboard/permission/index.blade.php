@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .position {
            float: right;
            margin-right: 25px;
        }
        .tableNiveau{
            margin-top: 70px;
        }
        .trash{
            color:red;
            margin-left: 7px;
        }
    </style>
    <div class="container">
    @include('includes.alerts.flash')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Permissions</li>
            </ol>
        </nav>
        <div class="row  position mb-5">
            <a  class="btn btn-primary " href="{{route('permissions.add')}}" ><i class="fas fa-plus"></i></a>
        </div>
        <!-- Modal add -->
     <!--   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('permissions.store')}}">
                        <label for=""> Permission:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"/>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                        @enderror
                            <button type="button" class="btn btn-primary">Créer</button>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>-->



        <div class="card shadow tableNiveau">
            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>
                    <tr>
                        <td class="col-4">#</td>
                        <td class="col-6">Permissions</td>

                        <td class="col-2">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $perm)
                        <tr>
                            <td class="col-4">{{$perm->id}}</td>
                            <td class="col-6">{{$perm->name}}</td>
                            <td class="col-4"><a href="{{route('permissions.edit',$perm->id)}}" ><i class="fas fa-pen fa-sm"></i></a>
                                <form action="{{route('permissions.destroy', $perm->id)}}" method="post" class="d-inline" >
                                    @csrf
                                    <a  class=" trash show_confirm" data-toggle="tooltip" title='Delete'><i class="fas fa-trash fa-sm"></i></a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                 </table>
             </div>
         </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $permissions->links() !!}
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





@endsection

