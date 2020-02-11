@extends('layouts.base')

@section("content")
  <h2>{{ $user -> name }}</h2>
  @foreach ($user -> apartments as $apartment)

    <div class="apartments">
      <h4>{{ $apartment -> address }}</h4>
    </div>
    @foreach ($apartment -> messages as $message)
      <div class="d-flex flex-column">
        <span class="sender">{{$message -> sender}} </span>
        <span class="d-none body_message"> {{$message -> text}}</span>
      </div>
    @endforeach
  @endforeach

@endsection
