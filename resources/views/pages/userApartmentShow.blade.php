@extends('layouts.base')

@section("content")
  <h2>{{ $user -> name }}</h2>
  @if(session()->has('message'))
    <div class="alert alert-success my_message">
        {{ session()->get('message') }}
    </div>
  @endif
  @foreach ($user -> apartments as $apartment)
  <div class="apartments">
      <h4>{{ $apartment -> address }}</h4>
      <p>{{ $apartment -> description }}</p>
      <img src="{{ $apartment -> poster_img }}" alt="">
    </div>

    <a href="{{ route('user.delete.apartment',  $apartment-> id) }}"><i class="fas fa-trash-alt"> Rimuovi appartamento </i></a>
  @endforeach
@endsection
