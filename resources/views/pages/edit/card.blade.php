@extends('layouts.app')

@section('content')

    <h1 class='header-2'>Write to patient's card</h1>

    <div class="container content col-md-12">
        <div class="row">

            <form class=" black_text" method="post" action="{{route('EditCard2',$id)}}">
                @csrf
                <input type="hidden" name="_method" value="PATCH"/>
                <div class="mb-3">
                    <label for="user_id" class="form-label">Patient id</label>
                    <input class="form-control" type="number" id="user_id" name="user_id" value="{{$card->user_id}}">

                    @error('user_id')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="mb-3">
                    <label for="session_name" class="form-label">session name</label>
                    <input class="form-control" type="text" id="session_name" name="session_name" value="{{$card->session_name}}">

                    @error('session_name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="mb-3">
                    <label class="form-label">Observations</label>
                    <textarea class="form-control" id="Observations" name="Observations" value="{{$card->Observations}}"></textarea>

                    @error('Observations')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-success" >Edit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
