@extends('layouts.app-admin')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
  <div class="card-header">
    Add level Data
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('levels.store') }}">
          <div class="col-md-4">
              @csrf
              <label for="level_name"> Level:</label>
              <input type="text" class="form-control" name="level"/>
          </div>
     <br>
          
          <button type="submit" class="btn btn-primary">Add Level</button>
      </form>
  </div>
</div>
@endsection