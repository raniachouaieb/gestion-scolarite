@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
@if(session()->get('error'))
    <div class="alert alert-danger">
      {{ session()->get('error') }}  
    </div><br />
  @endif
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
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