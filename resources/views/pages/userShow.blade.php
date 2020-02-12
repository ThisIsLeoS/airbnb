@extends('layouts.base')

@section("content")
  <div class="container">
    <div class="row">
      <div class="col-6 myCards">
        <div class="card" style="width: 18rem;">
          <img class="m-auto w-50 rounded-circle" src="https://a0.muscache.com/defaults/user_pic-225x225.png?v=3" alt="Card image cap">
          <a href="#" class="text-center">Aggiorna foto</a>
          <div class="card-body">
            <h4 class="card-title">{{$user ->name}}</h4>
            <p class="card-text">{{$user ->email}}</p>
            <a href="{{ route('userApartment.show',$user -> id) }}" class="btn btn-primary">I miei appartamenti({{ $user -> apartments() -> count()}}) </a>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="mt-5 ">
        <h1 class="display-4">Ciao {{ $user->name }}</h1>
        <a href="#" class="btn btn-dark">Modifica il profilo </a>

      </div>
    </div>
  </div>
</div>


@endsection
