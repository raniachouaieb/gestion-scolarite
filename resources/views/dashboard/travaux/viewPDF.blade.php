@extends('layouts.app-admin')

@section('content')

    <iframe src="{{asset('assets/'.$travail->file)}}"></iframe>
@endsection
