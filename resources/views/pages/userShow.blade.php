@extends('layouts.base')

@section("content")
<div class="container mt-5">
  <div class="row">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
      <div class="card">
        <img class="card-img-top" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/oslo.jpg" alt="Bologna">
        <div class="card-body text-center">
           @if (Auth::user() -> profile_img )
                  <img class="avatar rounded-circle" src="{{asset('images/UserProfileImg/'.Auth::user() -> profile_img)}}" alt=""  data-holder-rendered="true">
                  @else
                  <img class="avatar rounded-circle" src="https://a0.muscache.com/defaults/user_pic-225x225.png?v=3" alt="">
                  @endif

          <h6 class="card-text">Data di nascita: {{Auth::user() -> date_of_birth}}</h6>
          <p class="card-text">Email: {{Auth::user() -> email}} </p>
          <p class="card-text">Numero Appartamenti su BoolBnb: {{$user -> apartments() -> count()}} </p>
          <form action="{{route("user.set.image")}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <input class="btn btn-info" type="file" name="profile_img" >
                <input class="btn  btn-secondary mt-3" type="submit" value="Carica Immagine">
              </form>
        </div>
      </div>
    </div>
    <div class="col-sm-8  col-md-6 offset-lg-1 col-lg-5 d-flex flex-column justify-content-center">
        <h1>Ciao {{ $user->name }}</h1>
        <button class="mb-2"><a id="showMyApt" href="{{ route('userApartment.show',$user -> id) }}">I tuoi appartamenti({{ $user -> apartments() -> count()}}) </a></button>
        <button><a id="showMyApt" href="{{ route('apartment.create') }}">Aggiungi un nuovo appartamento </a></button>
    </div>
  </div>
</div>
{{-- <div class="container mt-5">
		<div class="row">
			<div class="col-sm-6">
				<div class="card-flip">
					<div class="flip">
						<div class="front">
							<div class="card">
                 @if (Auth::user() -> profile_img )
                  <img class="card-img-top" src="{{asset('images/UserProfileImg/'.Auth::user() -> profile_img)}}" alt=""  data-holder-rendered="true">
                  @else
                  <img class="card-img-top" src="https://a0.muscache.com/defaults/user_pic-225x225.png?v=3" alt="">
                  @endif
							  <div class="card-block">
                  <form action="{{route("user.set.image")}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <input type="file" name="profile_img" >
                <input type="submit" value="Carica Immagine">
              </form>
							    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							    <a href="{{ route('userApartment.show',$user -> id) }}">I miei appartamenti({{ $user -> apartments() -> count()}}) </a>
							  </div>
							</div>
						</div>
						<div class="back">
							<div class="card">
							  <div class="card-block">
							    <h6 class="card-subtitle text-muted">Support card subtitle</h6>
							  </div>
							  <img src="{{asset("images/logoAirbnb.png")}}" alt="Image [100%x180]" data-holder-rendered="true">
							  <div class="card-block">
							    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							    <a href="#" class="card-link">Card link</a>
							    <a href="#" class="card-link">Another link</a>
							  </div>
							</div>
						</div>
					</div>
				</div>
      </div>
      <div class="col-sm-6">
        <div class="mt-5 ">
          <h1>Ciao {{ $user->name }}</h1>
        </div>
      </div>
		</div>
	</div> --}}
@endsection
