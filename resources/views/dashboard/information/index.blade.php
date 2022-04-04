@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .position {
            float: right;
            margin-right: 25px;
        }
        .tableSeance{
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
                <li class="breadcrumb-item active" aria-current="page">Informations</li>
            </ol>
        </nav>
        <div class="row  position mb-5">
            <a  class="btn btn-primary " href="{{route('info.add')}}"><i class="fas fa-plus"></i></a>
        </div>



        <div class="card shadow tableSeance">
            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>
                    <tr>
                        <td class="col-1">#</td>
                        <td class="col-3">Sujet</td>
                        <td class="col-3">Information</td>
                        <td class="col-3">Classe</td>
                        <td class="col-2">Action</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($informations as $inf)
                            <tr>
                                <td class="col-1">{{$inf->id}}</td>
                                <td class="col-3">{{$inf->titre}}</td>
                                <td class="col-3">{!!  $inf->info!!}</td>

                                <td class="col-3">@foreach($classes as $clas) @if($inf->class_id == $clas->id){{$clas->name}}@endif @endforeach</td>


                                <td class="col-2"><a href="{{route('info.edit', $inf->id)}}" ><i class="fas fa-pen fa-sm"></i></a>


                                    <form action="{{route('info.destroy', $inf->id)}}" method="post" class="d-inline" >
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

