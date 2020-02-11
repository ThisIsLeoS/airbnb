@extends('layouts.base')

@section("content")
  <h2>{{ $user -> name }}</h2>
  @foreach ($user -> apartments as $apartment)

    <div class="apartments">
      <h4>{{ $apartment -> address }}</h4>
      <p>{{ $apartment -> description }}</p>
      <img src="{{ $apartment -> poster_img }}" alt="">
    </div>
    @foreach ($apartment -> messages as $message)
      <p>{{$message -> sender}}</p>
      <p>{{$message -> text}}</p>

    @endforeach
  @endforeach

@endsection
