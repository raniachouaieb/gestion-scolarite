@extends('layouts.app-admin')
@section('title', $title)

@section('content')

    <div class="container">

        <div class="table-responsive m-t-15">
            <table class="table table-striped custom-table">
                <thead>
                <tr>
                    <th>Rôles</th>
                    @foreach($roles as $rol)
                        <input type="hidden" name="id_role" value="{{$rol->id}}">
                    <th class="col-3">{{$rol->name}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $perm)
                <tr>
                    <td>{{$perm->name}}</td>
                    <td class="text-center">{{ Form::checkbox('permission[]', $perm->id, in_array($perm->id, $rolePermissions) ? true : false, array('class' => 'name')) }}</td>
                    <td class="text-center"><input checked="" type="checkbox" id="holidays" name="holidays" value="y"></td>

                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
