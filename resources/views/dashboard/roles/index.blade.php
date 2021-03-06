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
    <!--@include('includes.alerts.flash')  -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rôles</li>
            </ol>
        </nav>
        <div class="row  position mb-5">
            <a  class="btn btn-primary " href="{{route('roles.add')}}"><i class="fas fa-plus"></i></a>
        </div>



        <div class="card shadow tableNiveau">
            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>
                    <tr>
                        <td class="col-1">#</td>
                        <td class="col-3">Rôle</td>

                        <td class="col-2">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                       @foreach($roles as $role)
                        <tr>
                            <td class="col-4">{{$role->id}}</td>
                            <td class="col-5">{{$role->name}}</td>

                            <td class="col-3"><a href="{{route('roles.edit',$role->id)}}" ><i class="fas fa-pen fa-sm"></i></a>


                                <form action="{{route('roles.destroy', $role->id)}}" method="post" class="d-inline" >
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


        <div>
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

