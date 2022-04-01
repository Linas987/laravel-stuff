@extends('layouts.app')

@section('content')

<div class="container content col-md-12">
  <div class="row">
      <div class="col-sm">
          <p style="font-weight: 700 !important;">Sort By</p>
          <form method="post" action="{{route('DoctorSort')}}">
              @csrf
              <div style="padding-bottom: 10px;">
                  <button type="submit" class="btn btn-warning" name="sort" value='name'>Name</button>

                  <button type="submit" class="btn btn-warning" name="sort" value='occupation'>Occupation</button>

                  <button type="submit" class="btn btn-warning" name="sort" value='surname'>Surname</button>
              </div>
          </form>
          <p style="font-weight: 700 !important;">our doctors</p>
          <form class="black_text" method="post" action="{{ route('DoctorList') }}">
            @csrf
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">name</th>
                  <th scope="col">surname</th>
                  <th scope="col">occupation</th>
                  <th scope="col">Email</th>
                  <th scope="col">select</th>
                </tr>
              <thead>
                <tbody>
                    <?php  $i=0;  ?>
                    @foreach ($doctorsPage as $doctor)

                      <tr>
                      <td> {{$doctor->name}} </td>
                      <td>{{$doctor->surname}} </td>
                      <td>{{$doctor->occupation}}</td>
                      <td> {{$doctor->email}}</td>
                      <td> <!--input onchange='this.form.submit();' type='radio' id={{--$doctor->id--}} name='drone' value={{--$doctor->id--}}-->
                          <input type="hidden" name="arrnum" value=<?php  echo $i;  ?> />
                          <button class='btn btn-dark' type='submit' name='drone' value={{$doctor->id}}>pick</button>
                      </td>
                      </tr>
                      <?php  $i++;  ?>
                    @endforeach
                </tbody>
            </table>
              <span>
              {{$doctorsPage->appends(['sort' => $sort])->links()}}
            </span>
          </form>
      </div>
      <div class="col-sm">
          <p style="font-weight: 700 !important;">Work calendar</p>
          <form method="post" action="{{ route('DoctorList') }}">
              @csrf
              <button type="submit" class="btn btn-dark" name="previous" value='{{$doc_id}}'>previous month</button>
              <button type="submit" class="btn btn-info" name="current" value='{{$doc_id}}'>current month</button>
              <button type="submit" class="btn btn-dark" name="next" value='{{$doc_id}}'>next month</button>
          </form>
          @include('includes.DoctorCalendar')

      </div>
  </div>
</div>


@endsection
