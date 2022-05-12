@extends('layouts.app')

@section('content')

<h1 class='header'>Edit doctor {{$doctor->name}} {{$doctor->surname}}</h1>
    <div class="container content col-md-12">

        <form class="content black_text" method="post" action="{{route('EditDoctor3',$id)}}">
            @csrf
            <input type="hidden" name="_method" value="PATCH"/>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input class="form-control" type="text" id="username" name="username" value="{{$doctor->username}}">

                @error('username')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input class="form-control" type="text" id="email" name="email" value="{{$doctor->email}}">

                @error('email')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">occupation</label>
                <input class="form-control" type="text" name="occupation" value="{{$doctor->occupation}}">

                @error('occupation')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" value="{{$doctor->name}}">

                @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Surname</label>
                <input class="form-control" type="text" name="surname" value="{{$doctor->surname}}">

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
