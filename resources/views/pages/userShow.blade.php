@extends('layouts.base')

@section("content")
  <div class="container-fluid ">
    <div class="card" style="width: 20rem;">
      <div class="card-body card_center">
        <img class="img-profile" src="https://a0.muscache.com/defaults/user_pic-225x225.png?v=3" alt="Card image cap">
        <div class="card-body">
          <a href="#" class="card-link">Aggiorna foto</a>
        </div>
      </div>
      <div class="card-body">
        <h4 class="card-text"> {{$user ->name}} </h4>
        <p class="card-text"> {{$user -> email}} </p>
      </div>
    </div>
  </div>
  <div >
    <h1>Ciao, io sono {{ $user->name }}</h1>
    <a href="#">Modifica il profilo </a>
  </div>
  <div >
    @foreach ($user->apartments as $apartment)

      <a href="{{ route('userApartment.show',[ $user -> id, $apartment->id]) }}">I miei appartamenti</a>
      <a href="#">Messaggi ricevuti</a>
    @endforeach
  </div>

@endsection
