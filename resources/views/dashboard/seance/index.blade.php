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
                <li class="breadcrumb-item active" aria-current="page">Séances</li>
            </ol>
        </nav>
        <div class="row  position mb-5">
            <a  class="btn btn-primary " href="{{ route('seance.add')}}"><i class="fas fa-plus"></i></a>
        </div>



        <div class="card shadow tableSeance">
            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>
                    <tr>
                        <td class="col-1">#</td>
                        <td class="col-3">heure debut</td>
                        <td class="col-3">heure fin</td>
                        <td class="col-3">emploi</td>
                        <td class="col-2">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($seances)
                        @foreach($seances as $seance)
                            <tr>
                                <td class="col-2">{{$seance->id}}</td>
                                <td class="col-3">{{$seance->start_time}}</td>
                                <td class="col-3">{{$seance->end_time}}</td>
                                <td class="col-3">{{$seance->emploi['titre']}}</td>
                                <td class="col-2"><a href="{{route('seance.edit', $seance->id)}}" ><i class="fas fa-pen fa-sm"></i></a>


                                    <form action="{{route('seance.destroy', $seance->id)}}" method="post" class="d-inline" >
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

