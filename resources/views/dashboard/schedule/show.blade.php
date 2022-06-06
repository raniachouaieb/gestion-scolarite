@extends('layouts.app-admin')
{{-- Page title --}}
@section('title',$title)


@section('content')
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .header {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #2d3280;
            color: white;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}


    </style>
    <div class="container-fluid">
        @include('includes.alerts.flash')
        <div class="card">
            <div class="card-body">
    <div class="row" style=" margin-left: 0; margin-right: 0; ">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">{{__("Name")}}</label>
                <input type="text" value="{{old('name',$row->name)}}" disabled class="form-control">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="level">{{__("Level")}}</label>
                <input type="text" value="{{old('name',$row->level->level)}}" disabled class="form-control">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="classroom">{{__("Classroom")}}</label>
                <input type="text" value="{{old('name',$row->classroom->name)}}" disabled class="form-control">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="status">{{__("Status")}}</label>
                <input type="text" value="{{old('name',$status[$row->status])}}" disabled class="form-control">
            </div>
        </div>
        <div class="col-md-12">
        <table id="customers" border="5" cellspacing="0" align="center">
            <tr>
                <td class="header"  align="center" height="50">
                    <b>{{ __('Monday')}}</b>
                </td>

                    @foreach(json_decode($row->monday, true) as $member)
                        <td align="center" height="50">
                            <div class="row">
                                <div class="col-md-6"><b>{{ $member['from'] }}</b></div>
                                <div class="col-md-6"><b>{{ $member['to'] }}</b></div>
                                <div class="col-md-12">
                                    {{ $member['name'] }}
                                </div>
                            </div>

                        </td>
                    @endforeach
                    @for ($i =$size[0]; $i < max($size); $i++)
                        <td align="center" height="50">
                        </td>
                    @endfor

            </tr>
            <tr>
                <td class="header"  align="center" height="50">
                    <b> {{ __('Tuesday')}}</b>
                </td>
                     @foreach(json_decode($row->tuesday, true) as $member)
                        <td align="center" height="50">
                            <div class="row">
                                <div class="col-md-6"><b>{{ $member['from'] }}</b></div>
                                <div class="col-md-6"><b>{{ $member['to'] }}</b></div>
                                <div class="col-md-12">
                                    {{ $member['name'] }}
                                </div>
                            </div>

                        </td>
                    @endforeach
                    @for ($i =$size[1]; $i < max($size); $i++)
                        <td align="center" height="50">
                        </td>
                    @endfor
            </tr>
            <tr>
                <td class="header"  align="center" height="50">
                    <b> {{ __('Wednesday')}}</b>
                </td>
                    @foreach(json_decode($row->wednesday, true) as $member)
                        <td align="center" height="50">
                            <div class="row">
                                <div class="col-md-6"><b>{{ $member['from'] }}</b></div>
                                <div class="col-md-6"><b>{{ $member['to'] }}</b></div>
                                <div class="col-md-12">
                                    {{ $member['name'] }}
                                </div>
                            </div>

                        </td>
                    @endforeach
                    @for ($i =$size[2]; $i < max($size); $i++)
                        <td align="center" height="50">
                        </td>
                    @endfor
            </tr>
            <tr>
                <td class="header"  align="center" height="50">
                    <b> {{ __('Thursday')}}</b>
                </td>
                    @foreach(json_decode($row->thursday, true) as $member)
                        <td align="center" height="50">
                            <div class="row">
                                <div class="col-md-6"><b>{{ $member['from'] }}</b></div>
                                <div class="col-md-6"><b>{{ $member['to'] }}</b></div>
                                <div class="col-md-12">
                                    {{ $member['name'] }}
                                </div>
                            </div>

                        </td>
                    @endforeach
                    @for ($i =$size[3]; $i < max($size); $i++)
                        <td align="center" height="50">
                        </td>
                    @endfor
            </tr>
            <tr>
                <td class="header"  align="center" height="50">
                    <b> {{ __('Friday')}}</b>
                </td>

                    @foreach(json_decode($row->friday, true) as $member)
                        <td align="center" height="50">
                            <div class="row">
                                <div class="col-md-6"><b>{{ $member['from'] }}</b></div>
                                <div class="col-md-6"><b>{{ $member['to'] }}</b></div>
                                <div class="col-md-12">
                                    {{ $member['name'] }}
                                </div>
                            </div>

                        </td>
                    @endforeach
                    @for ($i =$size[4]; $i < max($size); $i++)
                        <td align="center" height="50">
                        </td>
                    @endfor
            </tr>

            <tr>
                <td class="header" align="center" height="50">
                    <b>{{ __('Saturday')}}</b>
                </td>

                    @foreach((array)json_decode($row->saturday, true) as $member)

                        <td align="center" height="50">
                            <div class="row">
                                <div class="col-md-6"><b>{{ $member['from'] }}</b></div>
                                <div class="col-md-6"><b>{{ $member['to'] }}</b></div>
                                <div class="col-md-12">
                                    {{ $member['name'] }}
                                </div>
                            </div>

                        </td>

                    @endforeach

                    @for ($i =$size[5]; $i < max($size); $i++)
                        <td align="center" height="50">
                        </td>
                    @endfor
            </tr>
        </table>
        </div>
    </div>
            </div>
        </div>
    </div>

@endsection
@section ('script.body')

@endsection
