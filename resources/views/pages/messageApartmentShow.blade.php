@extends('layouts.base')

@section("content")

  <div class="container-fluid">
    
    <div class="card-header text-center mt-3">
        <h3>I tuoi messaggi</h3>
      </div>
    <div class="row text-center">
      <div class="col-10 offset-1 offset-sm-0 col-sm-5 col-md-4 offset-xl-1 col-xl-2 mt-3">
        <div class="containerCard ">

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
      
      
      <div class="col-sm-7 col-md-8  col-xl-8 mt-3">
        
        <div>
        @foreach ($user -> apartments as $apartment)
          @if ($apartment->messages()->count() > 0)

            <div class="card mb-3"  {{-- style="width: 18rem;" --}}>
              <h4 class="card-title ">Appartamento {{ $apartment -> title }}</h4>
              <div class="card-body d-flex">
                @if ($apartment -> poster_img == "https://source.unsplash.com/random/1920x1280/?apartment")
                  
                    <img class="card-img-top d-none d-lg-block" src={{$apartment -> poster_img}} alt="Card image cap" style="width:18rem;height:18rem">
                  
                @elseif ($apartment -> poster_img == null)
                  
                    <img class="card-img-top d-none d-lg-block" src="{{URL::to('/images/noUpload.png')}}" alt="Card image cap" style="width:18rem;height:18rem">
                  
                @else
                  
                    <img class="card-img-top d-none d-lg-block" src="{{URL::to('/images/AptImg/'.$apartment->id."/".$apartment -> poster_img)}}" style="width:18rem;height:18rem" alt="Card image cap">
                  
                @endif
          <div>
          @foreach ($apartment -> messages as $message)
            <div class="d-flex flex-column  align-items-start">
              <span class="mb-2 ml-2"><strong>Ricevuto il {{date('d-m-Y', strtotime($message -> created_at)) }}</strong> </span>
              <span class="mb-2 ml-2 sender"><strong>Mittente :</strong> {{$message -> sender}}  <i class="fas fa-caret-down"></i><i class="fas fa-caret-up d-none"></i></span>
              <span class="mb-2 ml-2 d-none body_message"><strong>Messaggio :</strong> {{$message -> text}}</span>
            </div>
              @endforeach
               </div> 
              </div>
            </div>
            
          @endif
          
        @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
