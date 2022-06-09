
<style>
    .countParent{
        float: left;
        margin-left: 5px;
        margin-top: 1px;
        border: 1px ridge;
        box-shadow: 1px 1px 2px indianred;
        border-radius: 2px 4px 4px;
        padding: 1px 4px;
    }


    .ps-3 {
        padding-left: 1rem!important;
    }
    .box{
        box-shadow: 3px 3px 2px ;
        border-radius: 5px 5px 5px;
        border: 1px ;
        margin-bottom: 15px;
    }
    .table-responsive table thead tr{color: #ffffff;
        font-family: 'Nunito', sans-serif;
        font-weight: inherit}

</style>
<div class="container">
    <div class="text-right" style="margin-top: 10px;">
        <a href="{{route('schedule.admin.create',[$class,$niveau])}}" type="button"
           class="btn btn-outline-primary waves-effect waves-light" data-bs-toggle="tooltip"
           data-bs-placement="top" title="{{__('you don\'t have permission for the action')}}">
            <i class="fa fa-plus"></i> {{ __('Ajouter nouveau emploi')}}
        </a>

        <p><i>{{__('Total :total emploi',['total'=>count($schedules)])}}</i></p>
    </div>

    <div class="parentTab mb-4" id="list">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="bg-primary">

                    <tr>
                        <th> #</th>
                        <th> Nom</th>
                        <th>Niveau </th>
                        <th> Status </th>

                        <th colspan="1">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (is_array($schedules) || is_object($schedules))
                        @forelse($schedules as $item )
                            <tr>
                                <td style=" text-align: center; "> #{{$loop->index+1}}</td>
                                <td>

                                    <a href="{{ route('schedule.admin.show', ['id' => $item->id]) }}">{{$item->name}}</a>

                                </td>
                                <td>
                                    {{$item->level->level}}
                                </td>
                                <td>
                                    {{$status[$item->status]}}
                                </td>
                                <td>



                                    <a class="btn sbold uppercase btn-outline yellow-gold" href="{{ route('schedule.admin.edit', ['id' => $item->id]) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('schedule.admin.delete', $item->id)}}" method="post" class="d-inline" >
                                        @csrf

                                        <a  class=" trash show_confirm" data-toggle="tooltip" title='Delete'><i class="fas fa-trash fa-sm"></i></a>
                                    </form>

{{--                                    <a class="btn btn-outline-danger waves-effect waves-light"--}}
{{--                                       onclick="DoDeleted({{$item->id}})">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </a>--}}


                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Il n'exite aucun emploi pur le moment</td>
                            </tr>
                        @endforelse
                    @endif
                    </tbody>
                </table>

            </div>
        </div>

<div class="d-flex justify-content-center">
    {!! $schedules->links() !!}
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





