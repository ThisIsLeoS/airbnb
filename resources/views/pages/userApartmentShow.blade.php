@extends('layouts.base')

@section("content")
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h4 class="m-3 text-center">Gestisci i tuoi appartamenti</h4>

      </div>

    </div>

  </div>
  @if(session()->has('message'))
    <div class="alert alert-success my_message">
        {{ session()->get('message') }}
    </div>
  @endif
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 myCards">
        @foreach ($user->apartments as $apartment)
        <img class="avatar rounded-circle" src="{{asset('images/UserProfileImg/'.Auth::user() -> profile_img)}}" alt=""  data-holder-rendered="true">

        <div class="card" style="width: 18rem;">
          @if ($apartment -> poster_img == "https://source.unsplash.com/random/400x250/?apartment")
            <img class="card-img-top" src={{$apartment -> poster_img}} alt="Card image cap">
          @else
            <img class="card-img-top" src="{{URL::to('/images/AptImg/'.$apartment -> poster_img)}}" alt="Card image cap">
          @endif
          <div class="card-body ">
            <h4 class="card-title">{{$apartment -> title}}</h4>
            <p class="card-text">{{$apartment -> description}}</p>
            <a href="{{ route('apartment.edit',  $apartment-> id) }}" class="m-2 btn btn-primary"><i class="fas fa-pen"> Modifica appartamento </i></a>
            <a href="{{ route('user.delete.apartment',  $apartment-> id) }}" class=" m-2 btn btn-primary"><i class="fas fa-trash-alt"> Rimuovi appartamento </i></a>
            <a href="" class="m-2 btn btn-primary"><i class="fas fa-trash-alt"> Statistiche appartamento </i></a>
          </div>
        </div>

  @endforeach
      </div>
    </div>
  </div>
@endsection
