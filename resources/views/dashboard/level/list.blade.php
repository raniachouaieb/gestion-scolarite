@extends('layouts.app-admin')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
@include('includes.alerts.flash')  
<table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Level</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($levelName as $niveau)
        <tr>
            <td>{{$niveau->id}}</td>
            <td>{{$niveau->level}}</td>
            
            <td><a href="{{ route('levels.edit', $niveau->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('levels.destroy', $niveau->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection