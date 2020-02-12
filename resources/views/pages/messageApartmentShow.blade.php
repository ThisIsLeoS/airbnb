@extends('layouts.base')

@section("content")
  <h2>{{ $user -> name }}</h2>
  @foreach ($user -> apartments as $apartment)
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 myCards">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ $apartment -> poster_img }}" alt="Card image cap">
            <div class="card-body">
              <h4 class="card-title">{{ $apartment -> address }}</h4>
              @foreach ($apartment -> messages as $message)
                <div class="d-flex flex-column">
                  <span class="m-2 btn btn-primary sender">{{$message -> sender}} </span>
                  <span class="d-none body_message"> {{$message -> text}}</span>
                </div>
              @endforeach
            </div>
          </div>

        </div>

      </div>

    </div>


  @endforeach

@endsection
