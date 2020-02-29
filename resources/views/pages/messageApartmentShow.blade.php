@extends('layouts.base')

@section("content")
  <div class="container">
    <div class="row text-center">
      <div class="col-7  col-md-5 col-lg-3 mt-3">
        <div class="containerCard pl-5">

          <div class="border shadow ">
            @if (Auth::user() -> profile_img )
              <a  href="{{ route('user.show', Auth::user() -> id) }}">
                <div class="my_ovFlowHid">
                  <img class="card-img-top" src="{{asset('images/UserProfileImg/'.Auth::user() -> profile_img)}}" alt=""  data-holder-rendered="true">
                </div>

              </a>

            @else
              <a  href="{{ route('user.show', Auth::user() -> id) }}">

                <div class="my_ovFlowHid">
                  <img class="card-img-top" src="https://a0.muscache.com/defaults/user_pic-225x225.png?v=3" alt="">
                </div>
              </a>

            @endif
            <div class="card-body text-center">
              <div class="d-flex flex-column align-items-center">
                <h4 class="card-text"><b>{{Auth::user() -> name}}</b></h4>
                <p class="card-text">{{Auth::user() -> email}} </p>
                <p class="card-text">Appartamenti su BoolBnb: {{$user -> apartments() -> count()}} </p>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12  col-md-8 mt-3 myCards flex-column border noGutter rounded">
        <div class="card-header">
          <h3>I tuoi messaggi</h3>
        </div>
        <div>
        @foreach ($user -> apartments as $apartment)
          @if ($apartment->messages()->count() > 0)

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
          @endif
        @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
