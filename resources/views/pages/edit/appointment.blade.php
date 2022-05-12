@extends('layouts.app')

@section('content')
    <!-- calendar to edit time -->
    <h1 class='header-2'>Edit your appointment</h1>
    <div class="container content-2 col-md-12">
        @include('includes.DoctorCalendar')
    </div>
@endsection
