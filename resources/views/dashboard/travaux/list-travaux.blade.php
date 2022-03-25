@extends('layouts.app-admin')

@section('title', $title)
@section('content')
    <style>
        .trash{
            color:red;
            margin-left: 7px;
        }
        .position {
            float: right;
            margin-right: 20px;
        }
        .TravailTab{
            margin-top: 70px;
            margin-left: 18px;
        }
    </style>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Travaux à faire</li>
        </ol>
    </nav>

    <div class="container">
        <a  class="btn btn-primary position" href="{{ route('travails.addTravail')}}"><i class="fas fa-plus"></i></a>

    </div>
    <div class="container">
    <div class="card shadow mb-6 TravailTab">
        <div class="table-responsive">

            <table class="table table-hover">
                <thead>
                <tr>
                    <td class="col-2">travail</td>
                    <td class="col-3">matiere</td>
                    <td class="col-3">Classe</td>
                    <td class="col-2">Niveau</td>
                    <td class="col-2">Action</td>
                </tr>
                </thead>
                <tbody>
                @foreach($travaux as $trav)
                    <tr>
                        <td class="col-4">{{$trav->titre_travail}}</td>

                        <td class="col-3">@foreach($matieres as $matiere) @if($trav->matiere_id == $matiere->id){{$matiere->nom}}@endif @endforeach</td>
                        <td class="col-3">@foreach($classes as $class)@if($trav->class_id == $class->id) {{$class->name}} @endif @endforeach</td>
                        <td class="col-3">@foreach($niveaux as $niv)@if($trav->class->id_level == $niv->id) {{$niv->level}} @endif @endforeach</td>

                        <td class="col-2"><a href="{{route('travails.editTravail', $trav->id)}}"  type="submit" ><i class="fas fa-pen fa-sm"></i></a>


                            <form action="{{route('travails.destroy', $trav->id)}}" method="post" class="d-inline" >
                                @csrf
                                @method('DELETE')
                                <input name="_method" type="hidden" value="DELETE">
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
