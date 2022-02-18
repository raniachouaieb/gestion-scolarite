@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add class Data
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
      <form method="post" action="{{ route('classes.store') }}">
          <div class="form-group">
              @csrf
              <label for="name"> ClassRoom:</label>
              <input type="text" class="form-control" name="name"/>
          </div>
     
          
          <button type="submit" class="btn btn-primary">Add Classroom</button>
      </form>
  </div>
</div>
@endsection