@extends('layouts.app-admin')
@section('title', $title)

@section('content')
    <style>
        .position {
            float: right;
            margin-right: 20px;
        }
        .search{
            margin-left: 355px;
        }
        .nodata{
            color: red;
        }
        .convTab{
            margin-top: 70px;
            margin-left: 18px;
        }
        .iconSupp{
            margin-left: 30px;
        }
        .iconModif{
            margin-left: 11px;
        }

        .trashcolor{
            color:red;
        }
        .table-responsive table thead tr{color: #ffffff;
            font-family: 'Nunito', sans-serif;
            font-weight: inherit}
    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Convocations</li>

            </ol>
        </nav>

       <form  method="get" action="{{route('convocations.search')}}">
           @csrf
           <br>
           <div class="container">
               <div class="row">
                   <div class="form-group row search">
                       <div class="col-sm-9">
                           <input class="form-control mr-sm-2" name="search" id="search" type="text" placeholder="chercher">
                       </div>
                       <div class="col-sm-1">
                           <button class="btn btn-outline-info my-2 my-sm-0" type="submit"> <i class="fas fa-search"></i></button>
                       </div>
                   </div>
               </div>
           </div>
       </form>





        <div class="row  position mb-5">
            <a  class="btn btn-outline-primary position" href="{{ route('convocations.addConv')}}"><i class="fas fa-plus"></i> Ajouter</a>
        </div>

        <div class="card shadow mb-4 convTab">
            <div class="table-responsive">
                <!--<h3 class="align-content-center"> Total data : <span id="total_records"></span></h3>-->
                <table class="table table-striped">
                    <thead class="bg-primary">
                    <tr>
                        <th> Titre</th>
                        <th>Raison </th>
                        <th>Date Réunion </th>
                        <th>Eleve</th>
                        <th>Pere</th>
                        <th>Telephone</th>
                        <th colspan="2">Opérations</th>
                    </tr>
                    </thead>



                    <tbody>
                        @if($convocations && $convocations->count()>0)
                            @foreach($convocations as $conv)
                                <tr>
                                    <td>{{$conv->titre_conv}} </td>
                                    <td>{!! $conv->description !!}</td>
                                    <td>{{$conv->date_envoie}}</td>

                                    <td>{{$conv->student['nomEleve']}} {{$conv->student['prenomEleve']}}</td>


                                    <td>{{$conv->student->parent['nomPere']}} {{$conv->student->parent['prenomPere']}}</td>
                                    <td>{{$conv->student->parent['telPere']}}</td>

                                    <td>
                                        <form action="{{ route('convocations.destroy', $conv->id)}}" method="post" class="d-inline" >
                                            @csrf
                                            <a type="submit"  class=" show_confirm iconSupp" data-toggle="tooltip" title='Delete'><i class="fas fa-trash trashcolor"></i></a>
                                        </form>

                                    </td>


                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

             </div>


         </div>
        <div class="d-flex justify-content-center">
            {!! $convocations->links() !!}
        </div>
    </div>








    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {


            $('.show_confirm').click(function (event) {
                var form = $(this).closest("form");
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
        });

    </script>

    <script>
        $(document).ready(function(){
            //fetch_convocation_data();
            function fetch_convocation_data(query = '')
            {
                $.ajax({
                    url:"{{route('convocations.search')}}",
                    method:"GET",
                    data:{query:query},
                    dataType:'json',
                    success:function(data){
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);

                    }
                })
            }
            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                fetch_convocation_data(query);
            });
        });
    </script>




@endsection
