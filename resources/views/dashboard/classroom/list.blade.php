@extends('layouts.app-admin')
@section('title', $title)

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
          <td>Classroom</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($class as $classroom)
        <tr>
            <td>{{$classroom->id}}</td>
            <td>{{$classroom->name}}</td>
            
            <td><a href="{{ route('classes.edit', $classroom->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('classes.destroy', $classroom->id)}}" method="post">
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