@extends('layouts.base')

@section("content")
  <h2>{{ $user -> name }}</h2>
<div class="apartments">
  <ul>
    <li>{{ $apartment -> description }}</li>
    <li>{{ $apartment -> address }}</li>
    <li> <img src="{{ $apartment -> poster_img }}" alt=""> </li>
  </ul>
</div>

@endsection
