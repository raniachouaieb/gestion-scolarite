@extends('layouts.app-admin')
@section('title', $title)
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
  <div class="card-header">
    Edit Classroom Data
  </div>
  <div class="card-body">
   
      <form method="POST" action="{{ route('classes.update', $class->id ) }}">
      @csrf
          <div class="form-group">
              
              <label for="name">Classroom:</label>
              <input type="text" class="form-control" name="name" value="{{ $class->name }}"/>
          </div>
          
          
          <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
  </div>
</div>
@endsection