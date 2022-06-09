@extends('layouts.app-admin')
{{-- Page title --}}
@section('title',$title)

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Remarque module</li>
            </ol>
        </nav>

    <div class="card">
        <div class="card-body page-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="search-box me-2 d-inline-block">
                        @if(!empty($rows))
                            <form method="post" action="{{route('remarqueModule.admin.bulkEdit')}}"  class="filter-form filter-form-left d-flex justify-content-start bulkedit-search">
                                {{csrf_field()}}
                                <select name="action" class="form-control" style=" margin-right: 6px; padding-left: 12px; ">
                                    <option value="">{{__(" Bulk Actions ")}}</option>
                                    <option value="delete">{{__(" Delete ")}}</option>
                                </select>
                                <button type="submit" onclick="return confirm({{__("Do you want to delete?")}});"
                                        class="btn-info btn btn-icon dungdt-apply-form-btn">
                                    {{__('Apply')}}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6" style=" text-align: right; ">

                    <div class="search-box me-2 d-inline-block">
                        <form method="get"
                              class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row"
                              role="search">

                            <input type="text" name="s" value="{{ Request()->s }}"
                                   placeholder="{{__('Search by remarque')}}" class="form-control" style=" margin-right: 6px; padding-left: 12px; ">
                            <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Search')}}</button>
                        </form>
                    </div>
                </div><!-- end col-->
            </div>
        </div>
    </div>
    @include('includes.alerts.flash')

    <div class="card">
        <div class="card-body page-body">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="card-title">{{ __('Recommended remarks')}} ( {{__('Found :total items',['total'=>$rows->total()])}} )</h4>
                 </div>
                <div class="col-sm-6">
                    <div class="text-right">
                            <a href="{{route('remarqueModule.admin.create')}}"
                           class="btn btn-outline-primary waves-effect waves-light">{{ __('Add new remark')}}</a>



                    </div>
                </div>
            </div>
            <hr/>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-blue">
                    <tr>
                        <th width="60px"><input type="checkbox" class="check-all"></th>
                        <th>{{__('Remarks')}}</th>
                        <th class="date">{{ __('The author')}}</th>
                        <th class="date">{{ __('Created at')}}</th>
                        <th class="date">{{ __('Updated at')}}</th>
                        <th class="text-center" width="120px">{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($rows as $row)
                        <tr>
                            <td class="align-middle"><input type="checkbox" name="ids[]" value="{{$row->id}}" class="check-item"></td>
                            <td class="title align-middle">
                                <a href="{{route('remarqueModule.admin.edit', ['id' => $row->id])}}">{{$row->value}}</a>


                            </td>
                             <td class="align-middle">@if($row->getAuthor)  {{$row->getAuthor->name}} @else -- @endif </td>
                            <td class="align-middle">{{ date('d/m/Y',strtotime($row->created_at))}}</td>
                            <td class="align-middle">{{ date('d/m/Y',strtotime($row->updated_at))}}</td>
                            <td class="align-middle">
                                    <a href="{{route('remarqueModule.admin.edit', ['id'=>  $row->id  ])}}" target="_self"
                                       class="btn btn-outline-primary  waves-effect waves-light">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                <form action="{{ route('remarqueModule.admin.delete', $row->id)}}" method="post" class="d-inline" >
                                    @csrf

                                    <a  class=" trash show_confirm" data-toggle="tooltip" title='Delete'><i class="fas fa-trash fa-sm"></i></a>
                                </form>
{{--                                        <a class="btn btn-outline-danger waves-effect waves-light"--}}
{{--                                           onclick="DoDeleted({{$row->id}})">--}}
{{--                                            <i class="fa fa-trash"></i>--}}
{{--                                        </a>--}}


                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">{{__('No data available')}}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{$rows->appends(request()->query())->links()}}
        </div>
    </div>
    </div>


@endsection

@section('scripts')

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


@stop
