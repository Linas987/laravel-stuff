@extends('layouts.app')

@section('content')

<h1 class='header'>Your Medical Card</h1>
<div class="container content-2 col-md-12">
    <h5>History</h5>
    @if($cards->count())
        @foreach($cards as $card) {{--Card models--}}
    {{--d($card->user_id)--}}
        @if($card->user_id == auth()->user()->id)
            <div>
                {{$card->doctor->name}} the {{$card->doctor->occupation}} to {{$card->user->name}} at <a class="text-muted">{{$card->updated_at->isoFormat('Y-M-D')}}</a>
                <br>
                Session: {{$card->session_name}}
                <br>
                Observations: {{$card->Observations}}
                <br>
            </div>
        @endif
        @endforeach
    @else
        <p>there are no cards</p>
    @endif
</div>

@endsection
