@extends('layouts.app-admin')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
  <div class="card-header">
    Edit Level Data
  </div>
  <div class="card-body">
   @include('includes.alerts.flash')
      <form method="post" action="{{ route('levels.update', $level->id ) }}">
          <div class="col-md-4">
              @csrf
              @method('PATCH')
              <label for="level">Level:</label>
              <input type="text" class="form-control" name="level" value="{{ $level->level }}"/>
          </div>
          <br>
          
<button type="submit" class="btn btn-primary">Update Data</button>

  </div>
</div>
@endsection