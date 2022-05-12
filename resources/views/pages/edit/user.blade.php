@extends('layouts.app')

@section('content')

    <h1 class='header'>You are editing your account {{$user->name}} {{$user->surname}}</h1>
    <div class="container content col-md-12">

        <form class="content black_text" method="post" action="{{route('EditUser2',$id)}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PATCH"/>
            <div class="custom-file">
                <label>Update user icon</label>
                <input class="form-control-file" type="file" id="avatar" name="avatar">
                @error('avatar')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input class="form-control" type="text" id="username" name="username" value="{{$user->username}}">

                @error('username')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input class="form-control" type="text" id="email" name="email" value="{{$user->email}}">

                @error('email')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" value="{{$user->name}}">

                @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Surname</label>
                <input class="form-control" type="text" name="surname" value="{{$user->surname}}">

                @error('surname')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" type="password" name="password">

                @error('password')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-primary" name="">Update</button>
            </div>

        </form>
    </div>
@endsection
