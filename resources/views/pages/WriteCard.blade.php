@extends('layouts.app')

@section('content')

    <h1 class='header-2'>Write to patient's card</h1>

    <div class="container content col-md-12">
        @if($message=Session::get('success'))
            <div class="alert alert-success"><p>{{$message}}</p></div>
        @endif
        <div class="row">

        <form class=" black_text" method="post" action="{{route('WriteCard')}}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">Patient id</label>
                <input class="form-control" type="number" id="user_id" name="user_id" value="{{$selectedUserId ?? ''}}">

                @error('user_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="session_name" class="form-label">session name</label>
                <input class="form-control" type="text" id="session_name" name="session_name">

                @error('session_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Observations</label>
                <textarea class="form-control" id="body" name="body"></textarea>

                @error('body')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="custom-file">
                <label>Upload document</label>
                <input class="form-control-file" type="file" id="file" name="file">
                @error('file')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-success" >Post</button>
            </div>

        </form>
        <h5>History</h5>
            <div class="container content col-md-12">
                <div class="row">
                    <div class="col-sm">
                        <h6>Cards</h6>
                        @if($cards->count())
                            @foreach($cards as $card) {{--Card models--}}
                            @if($card->doctor->id == auth('doctor')->user()->id)
                                <div>
                                    {{$card->doctor->name}} the {{$card->doctor->occupation}} to {{$card->user->name}} at <a class="text-muted">{{$card->updated_at->isoFormat('Y-M-D')}}</a>
                                    <br>
                                    Session: {{$card->session_name}}
                                    <br>
                                    Observations: {{$card->Observations}}
                                    <br>
                                    @if($card->file)
                                    <a href="download/{{$card->file}}" style="color: cadetblue"> Download Document </a>
                                    @endif
                                    <form class=" black_text" method="get" action="{{route('EditCard',$card->id)}}">
                                        <button class='btn btn-info' type='submit' name='drone' value={{$card->id}}>Edit</button>
                                    </form>
                                    <form class=" black_text" method="post" action="{{route('DeleteCard')}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class='btn btn-danger' type='submit' name='drone' value={{$card->id}}>DELETE</button>
                                    </form>
                                </div>
                            @endif
                            @endforeach
                        @else
                            <p>there are no cards</p>
                        @endif
                    </div>
                    <div class="col-sm">
                        <h6>Removed user cards</h6>
                        @if($invalidCards->count())
                            @foreach($invalidCards ?? '' as $invalidCard)
                            @if($invalidCard->doctor->id == auth('doctor')->user()->id)
                                <div>
                                    {{$invalidCard->doctor->name}} the {{$invalidCard->doctor->occupation}} to {{$invalidCard->name}} {{$invalidCard->surname}} at <a class="text-muted">{{$invalidCard->updated_at->isoFormat('Y-M-D')}}</a>
                                    <br>
                                    Session: {{$invalidCard->session_name}}
                                    <br>
                                    Observations: {{$invalidCard->Observations}}
                                    <br>
                                </div>
                            @endif
                            @endforeach
                        @else
                            <p>there are no deleted user cards</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
