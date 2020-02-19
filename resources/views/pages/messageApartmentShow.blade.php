@extends('layouts.base')

@section("content")
  <div class="container">
    <div class="row text-center">
      <div class="col-12 mt-3 myCards flex-column">
        <div class="card-header">
          <h3>I tuoi messaggi</h3>
        </div>
        <div>
        @foreach ($user -> apartments as $apartment)
          <div class="card" >
            <div class="card-body">
              <h4 class="card-title card-header">Appartamento {{ $apartment -> title }}</h4>
              @foreach ($apartment -> messages as $message)
                <div class="d-flex flex-column justify-content-center align-items-center">
                  <span class="m-2 sender"><strong>Mittente :</strong> {{$message -> sender}} <i class="fas fa-caret-down"></i><i class="fas fa-caret-up d-none"></i></span>
                  <span class="d-none body_message"><strong>Messaggio :</strong> {{$message -> text}}</span>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
        </div>
      </div>
    </div>  
  </div>  
@endsection
