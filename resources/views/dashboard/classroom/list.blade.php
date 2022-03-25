@extends('layouts.app-admin')
@section('title', $title)

@section('content')
<style>
    .position {
        float: right;
        margin-right: 20px;
    }
  .trashcolor{
      color: red;
      margin-left: 7px;
  }
  .class{
      margin-top: 70px;
      margin-left: 18px;
  }
</style>
<div class="container">

@include('includes.alerts.flash')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Groupes</li>
            </ol>
        </nav>
    <div class="row  position mb-5">
        <a  class="btn btn-primary position" href="{{ route('classes.add')}}"><i class="fas fa-plus"></i></a>
    </div>
    <div class="card shadow mb-6 class">
        <div class="table-responsive">
                    <table class="table table-hover">

                                <thead>
                                    <tr>
                                        <th class="col-4">#</th>
                                        <th class="col-6">Classe</th>
                                        <th class="col-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($class as $classroom)
                                <tr>

                                    <td class="col-4">{{$classroom->id}}</td>
                                    <td class="col-6">{{$classroom->name}}</td>
                                    <td class="col-2"><a href="{{ route('classes.edit', $classroom->id)}}" ><i class="fas fa-pen fa-sm"></i></a>

                                        <form action="{{ route('classes.destroy', $classroom->id)}}"  method="post" class="d-inline" >
                                            @csrf
                                            @method('DELETE')
                                            <input name="_method" type="hidden" value="DELETE">
                                            <a  type="submit" class=" show_confirm trashcolor" data-toggle="tooltip" title='Delete'><i class="fas fa-trash fa-sm"></i></a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                    </table>
         </div>
     </div>
<div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
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
