@extends('layouts.app-admin')
@section('title', $title)
<style>
    .position {
        margin-left: 964px;
        margin-top: 38px;    }
    .tableEns{
        margin-top: 45px;
    }
    .trash{
        color: red;
    }
    .table-responsive table thead tr{color: #ffffff;
        font-family: 'Nunito', sans-serif;
        font-weight: inherit}
</style>
@section('content')
<div class="container">
            @include('includes.alerts.flash')
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Liste des enseinants</li>
                </ol>
            </nav>
                <a  class="btn btn-outline-primary position " href="{{route('enseignant.add')}}"><i class="fas fa-plus"></i> Ajouter</a>
            <div class="card shadow tableEns">
                <div class="table-responsive">

                    <table class="table table-striped" id="user_table">
                        <thead class="bg-primary">
                        <tr>
                            <td class="col-2">{{__('Nom & Prénom')}}</td>
                            <td class="col-2">{{__('Téléphone')}}</td>
                            <td class="col-2">{{__('Date d`embauche')}}</td>
                            <td class="col-2">{{__('Spécialité')}}</td>
                            <td class="col-2">{{__('Module')}}</td>
                            <td class="col-1">{{__('Status')}}</td>

                            <td class="col-1">{{__('Action')}}</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($enseignants as $ens)
                            <tr>

                                <td>{{$ens->nom}} {{$ens->prenom}}</td>
                                <td>{{$ens->telephone}}</td>
                                <td>{{$ens->date_embauche}}</td>
                                <td>{{$ens->specilaite}}</td>
                                <td>@foreach($modules as $modul) @if($modul->id == $ens->module_id){{$modul->nom_module}} @endif @endforeach</td>
                                <td>
                                    <form action="{{route('changeStatus', $ens->id)}}" method="post">
                                        @csrf

                                        <button class="btn btn-sm {{($ens->status =='Active')?'btn-success' : 'btn-danger'}}" type="submit" >
                                            @if($ens->status =='Active')
                                                Make Inactive
                                            @else
                                                Make Active
                                            @endif
                                        </button>

                                    </form>
                                </td>

                                <td>
                                    <a href="{{route('enseignant.edit', $ens->id)}}" ><i class="fas fa-pen fa-sm"></i></a>


                                    <form action="{{route('enseignant.destroy', $ens->id)}}" method="post" class="d-inline" >
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
    <div class="d-flex justify-content-center mt-5">
        {!! $enseignants->links() !!}
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
