@extends('layouts.app')

@section('content')

    <div class="container col-md-6">
        <h1 class="header " style="min-width: 503px;">Our Patient Database</h1>
        <div>
        <table class="table content-2 table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">\</th>
                <th scope="col">name</th>
                <th scope="col">surname</th>
                <th scope="col">Email</th>
                <th scope="col">ID</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($users as $user)

                <tr>
                    <td><img src="/uploads/avatars/{{$user->avatar}}" style="width: 20px; height: 20px; float:left; border-radius:50%; margin-right: 0px"></td>
                    <td> {{$user->name}} </td>
                    <td>{{$user->surname}} </td>
                    <td> {{$user->email}}</td>
                    <td> {{$user->id}}</td>
                </tr>

            @endforeach


            </tbody>
        </table>
        </div>
    </div>
@endsection
