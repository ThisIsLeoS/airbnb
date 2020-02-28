@extends("layouts.base")

@section("content")
<style>

  /* addrress' autocomplete rules */
  .my_style_drop {
    top: 0;
  }
</style>

<div class="container-fluid" id="update-aptm-container">
  <h3 class="text-center">
    Ciao {{ Auth::user() -> name }}! Modifica il tuo appartamento.
  </h3>
  <div class="row">
    <div class="col-lg-6">
      <form id="update-aptm-form" action="{{ route("apartment.update", $apartment -> id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("POST")
        <div class="d-flex flex-column">

          {{-- title --}}
          <label for="title">Titolo</label>
          <input type="text" name="title" value="{{ $apartment -> title }}" class="@error("title") is-invalid @enderror" required maxlength="255">
          @error("title")
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          {{-- /title --}}

          {{-- description --}}
          <label for="description">Descrizione</label>
          <input type="text" name="description" value="{{ $apartment -> description }}" class="@error("description") is-invalid @enderror" required maxlength="255">
          @error("description")
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          {{-- /description --}}
          
          {{-- address --}}
          <label for="update-address">Indirizzo dell"appartamento</label>
          <input type="text" id="update-address" name="address" value="{{ $apartment -> address }}" class="@error("address") is-invalid @enderror" required maxlength="255">
          <div id="addressesList"></div>
          @error("address")
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          {{-- /address --}}
          
          <div class="inputs-number-container">
            
            {{-- square feet --}}
            <div>
              <label for="square_feet">Metri quadri</label>
              <input type="number" name="square_feet" value="{{ $apartment -> square_feet }}" class="@error("square_feet") is-invalid @enderror" required min="1" max="1000">
              @error("square_feet")
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            {{-- /square feet --}}

            {{-- rooms --}}
            <div>
              <label for="rooms">Stanze</label>
              <input type="number" name="rooms" value="{{ $apartment -> rooms }}" class="@error("rooms") is-invalid @enderror" required min="1" max="10">
              @error("rooms")
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div> 
            {{-- /rooms --}}

            {{-- beds --}}
            <div>
              <label for="beds">Letti</label>
              <input type="number" name="beds" value="{{ $apartment -> beds }}" class="@error("beds") is-invalid @enderror" required min="1" max="10">
              @error("beds")
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            {{-- /beds --}}
            
            {{-- bathrooms --}}
            <div>
              <label for="bathrooms">Bagni</label>
              <input type="number" name="bathrooms" value="{{ $apartment -> bathrooms }}" class="@error("bathrooms") is-invalid @enderror" required min="1" max="10">
              @error("bathrooms")
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            {{-- /bathrooms --}}
            
          </div>

          {{-- main image --}}
          <label id="main-img-label">Immagine principale</label>
          @if ($apartment -> poster_img === "https://source.unsplash.com/random/1920x1280/?apartment")
            <div id="main-img" style="background-image: width:180px; height:180px; url('https://source.unsplash.com/random/1920x1280/?apartment'); background-size: cover; background-position:center;">
            </div>
          @elseif($apartment -> poster_img !== null)
            <div id="main-img" style="width:180px; height:180px; background:url('/images/AptImg/{{$apartment -> id}}/{{$apartment -> poster_img}}'); background-size:cover; background-position:center;">
            </div>
          @endif
          <input type="file" name="poster_img" value="{{ $apartment -> poster_img }}" class="@error("poster_img") is-invalid @enderror">
          @error("poster_img")
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          {{-- /main image --}}

          {{-- services --}}
          <label>Quali servizi metti a disposizione?</label>
          <div id="services-container">
            @foreach ($services as $service)
              <input type="checkbox" name="services[]" value="{{ $service -> id }}" @if ($apartment -> services() -> find($service -> id)) checked  @endif class="@error("services") is-invalid @enderror">
              <label for="">{{ $service -> type }}</label>
            @endforeach
          </div>
          @error("services")
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          {{-- /services --}}

          <button id="update-aptm-btn">Modifica Appartamento</button>
        </div>
      </form>
    </div>
    <div class="col-lg-6 myBgCreateUpd d-md-none d-lg-block">
    </div>
  </div>
</div>
@endsection
