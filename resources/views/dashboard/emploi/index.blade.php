@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .position {
            float: right;
            margin-right: 25px;
        }
        .tableEmploi{
            margin-top: 70px;
        }
        .trash{
            color:red;
            margin-left: 7px;
        }
        .table-responsive table thead tr{color: #ffffff;
            font-family: 'Nunito', sans-serif;
            font-weight: inherit}
    </style>
    <div class="container">
    @include('includes.alerts.flash')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Emplois</li>
            </ol>
        </nav>
        <div class="row  position mb-5">
            <a  class="btn btn-outline-primary " href="{{ route('emploi.add')}}"><i class="fas fa-plus"></i> Ajouter</a>
        </div>



        <div class="card shadow tableEmploi">
            <div class="table-responsive">

                <table class="table table-striped">

                    <thead class="bg-primary">
                    <tr>
                        <td class="col-4">#</td>
                        <td class="col-6">Emploi</td>
                        <td class="col-2">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($emplois)
                    @foreach($emplois as $emploi)
                        <tr>
                            <td class="col-4">{{$emploi->id}}</td>
                            <td><a href="">{{$emploi->titre}}</a></td>
                            <td class="col-2"><a href="{{ route('emploi.editEmploi', $emploi->id)}}" ><i class="fas fa-pen fa-sm"></i></a>


                                <form action="{{route('emploi.destroy', $emploi->id)}}" method="post" class="d-inline" >
                                    @csrf
                                    @method('DELETE')
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a  class=" trash show_confirm" data-toggle="tooltip" title='Delete'><i class="fas fa-trash fa-sm"></i></a>
                                </form>


                            </td>
                        </tr>
                    @endforeach
                    @endif
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

