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
            @method('DELETE')
          <table class="table">
              <thead>
              <tr>
                  <th scope="col">name</th>
                  <th scope="col">surname</th>
                  <th scope="col">date register</th>
                  <th scope="col">Time</th>
                  <th scope="col">revoke appointment</th>
                  <th scope="col">edit time</th>
              </tr>
              <thead>
              <tbody>
                  <?php
                        //sort by Date_register
                        function sortByDate($a, $b) {
                            return (int) ($a['date_register'] > $b['date_register']);
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
                                <td><button class='btn btn-danger btn-lg my-1' type='submit' name='drone' value={{$D['id']}}>DELETE</button></td>
                                <td>
                                <a href='{{route('EditDate',$D['id'])}}' type='button' class='btn btn-info btn-lg my-1'>EDIT</a>
                                </td>
                                </tr>
                                <?php
                            }
                  ?>
              </tbody>
          </table>
        </form>
      </div>
          <div>
              <script>
                  //JavaScript function that enables or disables a submit button depending
                  //on whether a checkbox has been ticked or not.
                  function terms_changed(termsCheckBox){
                      //If the checkbox has been checked
                      if(termsCheckBox.checked){
                          //Set the disabled property to FALSE and enable the button.
                          document.getElementById("btncheck").disabled = false;
                      } else{
                          //Otherwise, disable the submit button.
                          document.getElementById("btncheck").disabled = true;
                      }
                  }
              </script>
              <div>
                  <p style="font-weight: 700 !important; color: blue">if you want to edit your account</p>
                  <a href="{{route('EditUser',auth()->user()->id)}}" type="button" class='btn btn-info btn-sm'>Edit</a>
              </div>
              <br>
              @cannot('create doctor')
                  <form class="black_text" method="post" action="{{route('dashboard')}}">
                      @csrf
                      @method('DELETE')
                      <p style="font-weight: 700 !important; color: crimson">if you want to delete your account</p>
                      <button class='btn btn-danger btn-sm my-1' id="btncheck" type='submit' name='drone' value={{auth()->user()->id}} disabled>!DELETE!</button>
                      <label>
                          <input type="checkbox" id="chkbox1" name="checkbox" value="1" onclick="terms_changed(this)"> Yes I know what I'm doing and I want to delete my account
                      </label>
                  </form>
              @endcannot
          </div>
  </div>
</div>

@endsection
