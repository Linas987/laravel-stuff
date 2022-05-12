<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
      <link href="{{ asset('bower_components/datatables/media/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <title>Hospital</title>
  </head>
  <body>
    <div class="header-2">
        @if (auth('web')->user())
            <img src="/uploads/avatars/{{auth()->user()->avatar}}" style="width: 150px; height: 150px; float:left; border-radius:50%; margin-right: 0px">
        @endif
      <h1>Hospital</h1>

      <!-- if the user is autentificateted will show logout button -->
        @if (auth('doctor')->user())
            <p class="h3"> Welcome {{ auth('doctor')->user()->name }} {{ auth('doctor')->user()->surname }} the {{ auth('doctor')->user()->occupation }} </p>
            <a href="{{ route('doctordashboard') }}" type="button" class="btn btn-primary btn-lg my-1">Home</a>
            <a href="{{ route('PatientList') }}" type="button" class="btn btn-secondary btn-lg my-1">Patient list</a>
            <a href="{{ route('WriteCard') }}" type="button" class="btn btn-primary btn-lg my-1">Write card</a>
            <a href="{{ route('logout') }}" type="button" class="btn btn-danger btn-lg my-1">Log out</a>
        @elseif (auth()->user())
            <p class="h3"> Welcome {{ auth()->user()->name }} {{ auth()->user()->surname }}  </p>
            @can('create doctor')
                <p>U R ADMIN</p>
                <a href="{{ route('MakeDoctor') }}" type="button" class="btn btn-warning btn-lg my-1">create doctor</a>
                <a href="{{ route('EditDoctor') }}" type="button" class="btn btn-warning btn-lg my-1">Edit doctor</a>
            @endcan
            <a href="{{ route('dashboard') }}" type="button" class="btn btn-primary btn-lg my-1">Home</a>
            <a href="{{ route('DoctorList') }}" type="button" class="btn btn-success btn-lg my-1">register to a doctor</a>
            <a href="{{ route('Card') }}" type="button" class="btn btn-success btn-lg my-1">Pacient card</a>
            <a href="{{ route('logout') }}" type="button" class="btn btn-danger btn-lg my-1">Log out</a>
        @else
            <a href="{{ route('login') }}" type="button" class="btn btn-primary btn-lg my-1">Log in</a>
            <a href="{{ route('register') }}" type="button" class="btn btn-secondary btn-lg my-1">Register</a>
        @endif

    </div>
    <div>
      <!--h2>Login</h2-->
      <div class="row black_text">


        <div class="col-lg-12">
            @yield('content')
        </div>



      </div>
    </div>





    <!-- Optional JavaScript; choose one of the two! -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
    @yield('extra-script')
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
  <!-- Footer -->
  <footer class="footer bg-light text-center text-lg-start">
      <!-- Grid container -->
      <div class="container p-4">
          <!--Grid row-->
          <div class="row">
              <!--Grid column-->
              <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                  <p>
                      This is My footer and my project
                  </p>
              </div>
              <!--Grid column-->
          </div>
          <!--Grid row-->
      </div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          <a class="text-dark">My site Linas Ramanauskas</a>
      </div>
      <!-- Copyright -->
  </footer>
  <!-- Footer -->
</html>
