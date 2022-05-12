@extends('layouts.app')

@section('content')

    <div class="container content col-md-12">
        <div class="row">
            @if($message=Session::get('success'))
                <div class="alert alert-success"><p>{{$message}}</p></div>
            @endif
                <p style="font-weight: 700 !important;">our doctors</p>
                <form class="black_text" method="post" action="{{ route('EditDoctor') }}">
                    @csrf
                    @method('DELETE')
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">surname</th>
                            <th scope="col">occupation</th>
                            <th scope="col">Email</th>
                            <th scope="col">edit</th>
                            <th scope="col">delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($doctors as $doctor)

                            <tr>
                                <td> {{$doctor->id}} </td>
                                <td> {{$doctor->name}} </td>
                                <td>{{$doctor->surname}} </td>
                                <td>{{$doctor->occupation}}</td>
                                <td> {{$doctor->email}}</td>
                                <td>
                                    <!--button class='btn btn-info' type='submit' name='drone' value={{--$doctor->id--}}>edit</button-->
                                    <a href="{{route('EditDoctor2',$doctor->id)}}" type="button" class='btn btn-info'>EDIT</a>
                                    {{-- Form::model($user, ['route' => ['updateroute', $user->id], 'method' => 'patch']) --}}
                                </td>
                                <td>
                                    <button class='btn btn-danger' type='submit' name='drone' value={{$doctor->id}}>DELETE</button>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </form>
        </div>
    </div>

@endsection
