@extends('layouts.app-admin')
{{-- Page title --}}
@section('title')
    {{$row->id ? __('Edit remark: ').$row->name : __('Add new remark')}}
@stop
@section('title',$title)

{{-- Page body --}}
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Remarque module</li>
            </ol>
        </nav>
    <form action="{{route('remarqueModule.admin.store', ['id'=>($row->id) ? $row->id : '-1']) }}" method="post"
          class="notSendAjax needs-validation" novalidate>
        @csrf
        @include('includes.alerts.flash')

        <div class="card">
            <div class="card-body page-body">
                <div class="mb-3">
                    <label for="value">{{__("Remark")}}</label>
                    <input type="text" value="{{old('value',$row->value)}}" name="value" id="value" placeholder="{{__("Your remark")}}"
                           class="form-control @error('value') is-invalid @enderror">
                    @error('value')
                    <span class="invalid-feedback" style="border-color: #fbe1e3;color: #e73d4a;float: left;padding-bottom: 10px; " role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <span></span>
            <button class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
        </div>
    </form>
    </div>

@endsection
{{-- Page script --}}
@section ('scripts')


@endsection
