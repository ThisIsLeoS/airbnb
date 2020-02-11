@extends('layouts.base')

@section("content")
  <h2>{{ $user -> name }}</h2>
  @foreach ($user -> apartments as $apartment)

    <div class="apartments">
      <h4>{{ $apartment -> address }}</h4>
    </div>
    @foreach ($apartment -> messages as $message)
      <p class="message_apt">{{$message -> sender}}</p>
      <p class="d-none bodyMessage">{{$message -> text}}</p>

    @endforeach
  @endforeach

@endsection
