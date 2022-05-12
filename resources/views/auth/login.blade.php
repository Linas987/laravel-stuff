@extends('layouts.app')

@section('content')
    <div class="container header col-md-6">

      <div>

       <h2>Login</h2>

        <form class="content black_text" method="post" action="{{route('login')}}">

          @if (session('status'))
          <div class="text-danger">
            {{ session('status') }}
          </div>
          @endif

          @csrf

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input class="form-control" type="text" id="username" name="username" value="{{old('username')}}">

            @error('username')
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

          <div style="padding-bottom: 10px;">
            <button type="submit" class="btn btn-success" name="">Login</button>
          </div>

              <a href="{{url('auth/google')}}" class="btn btn-primary">Use google login</a>

        </form>
      </div>

    </div>
@endsection
