@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .position {
            float: right;
            margin-right: 20px;
        }
        .matiereTab{
            margin-top: 70px;
            margin-left: 18px;
        }
        .colrtrash{
            color: red;
            margin-left: 7px;
        }
        .table-responsive table thead tr{color: #ffffff;
            font-family: 'Nunito', sans-serif;
            font-weight: inherit}
    </style>
    <div class="container">
    <!--@include('includes.alerts.flash')  -->

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Matières</li>
            </ol>
        </nav>
        <div class="row  position mb-5">
            <a  class="btn btn-primary position" href="{{ route('matieres.add')}}"><i class="fas fa-plus"></i> Ajouter </a>
        </div>
        <div class="card shadow mb-6 matiereTab">
             <div class="table-responsive">

                 <table class="table table-striped">
                     <thead class="bg-primary">
                                <tr>
                                    <td>Nom</td>
                                    <td>Module</td>
                                    <td>Coefficient</td>
                                    <td colspan="2">Action</td>
                                </tr>
                                </thead>
                            <tbody>
                            @foreach($matiere as $mat)
                                <tr>
                                    <td>{{$mat->nom}}</td>
                                    @foreach($module as $modul)
                                    <td @if($modul->id == $mat->module_id ) > {{$modul->nom_module}} </td>@endif
                                    @endforeach

                                    <td>{{$mat->coefficient}}</td>
                                    <td><a href="{{ route('matieres.edit', $mat->id)}}" ><i class="fas fa-pen fa-sm"></i></a>


                                        <form action="{{ route('matieres.destroy', $mat->id)}}" method="post" class="d-inline" >
                                            @csrf
                                            @method('DELETE')
                                            <input name="_method" type="hidden" value="DELETE">
                                            <a type="submit" class=" show_confirm" data-toggle="tooltip" title='Delete'><i class="fas fa-trash fa-sm colrtrash"></i></a>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                     </table>
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

