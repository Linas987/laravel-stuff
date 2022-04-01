@extends('layouts.app')

@section('content')

<h1 class='header'>Welcome to our hospital</h1>
@if($message=Session::get('warning'))
    <div class="alert alert-warning"><p>{{$message}}</p></div>
@endif
@endsection
