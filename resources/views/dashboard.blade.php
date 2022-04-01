@extends('layouts.app')

@section('content')

<div class="container content col-md-12">
  <div class="row">
      @if($message=Session::get('success'))
          <div class="alert alert-success"><p>{{$message}}</p></div>
      @endif
      <div class="col-sm">
        <p style="font-weight: 700 !important;">This ir our currentelly registered users number</p>
        <p class="Big_text">{{ DB::table('users')->count() }}</p>
      </div>
      <div class="col-sm">
      <p style="font-weight: 700 !important;">Upcoming appointments</p>
            @php
                $data=array();
            @endphp
        @foreach($doctors as $doctor)
              @foreach($doctor->users as $user)
                    {{--dd($user->pivot->Times)--}}
                  @if($user->id == auth()->user()->id and $user->pivot->date_register>=date('Y-m-d'))
                      @php
                        array_push($data,["name"=>$doctor->name,"surname"=>$doctor->surname,"date_register"=>$user->pivot->date_register,"Times"=>$user->pivot->Times,"id"=>$user->pivot->id]);
                      @endphp
                  @endif
              @endforeach
        @endforeach
        <form class="black_text" method="post" action="{{route('Date')}}">
            @csrf
            <!--@method('DELETE')-->
          <table class="table">
              <thead>
              <tr>
                  <th scope="col">name</th>
                  <th scope="col">surname</th>
                  <th scope="col">date register</th>
                  <th scope="col">Time</th>
              </tr>
              <thead>
              <tbody>
                  <?php
                        //sort by Date_register
                        function sortByDate($a, $b) {
                            return $a['date_register'] > $b['date_register'];
                        }
                        usort($data,'sortByDate');
                        foreach($data as $D)
                            {
                                ?>
                                <tr>
                                <td>{{$D['name']}}</td>
                                <td>{{$D['surname']}}</td>
                                <td>{{$D['date_register']}}</td>
                                <td>{{$D['Times']}}</td>
                                </tr>
                                <?php
                            }
                  ?>
              </tbody>
          </table>
        </form>
      </div>
  </div>
</div>

@endsection
