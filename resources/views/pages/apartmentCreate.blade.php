@extends("layouts.base")

@section("content")
<style>
  
  /* addrress' autocomplete rules */
  .my_style_drop {
    top: 0;
  }
</style>

<div class="container-fluid" id="create-aptm-container">
  <h3 class="text-center">
    Ciao {{ Auth::user() -> name }}! Aggiungi un nuovo appartamento.
  </h3>
  <div class="row">
    <div class="col-lg-6">
      <form id="create-aptm-form" action="{{ route("apartment.store", Auth::user() -> id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("POST")
        <div class="d-flex flex-column">

          {{-- title --}}
          <label for="title">Inserisci una breve titolo</label>
          <input type="text" id="title" name="title" class="@error("title") is-invalid @enderror" required maxlength="255">
          @error("title")
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          {{-- /title --}}
          
          {{-- description --}}
          <label for="description">Inserisci una breve descrizione del tuo appartamento</label>
          <input type="text" id="description" name="description" class="@error("description") is-invalid @enderror" required maxlength="255">
          @error("description")
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          {{-- /description --}}

          {{-- address --}}
          <label for="address">Indirizzo dell'appartamento</label>
          <input type="text" id="address" name="address" class="@error("address") is-invalid @enderror" required maxlength="255">
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
              <label  for="square-feet">Metri quadri</label>
              <input type="number" id="square-feet" name="square_feet"  class="@error("square_feet") is-invalid @enderror" required min="1" max="1000">
            </div>
            {{-- /square feet --}}

            {{-- rooms --}}
            <div>
              <label for="rooms">Stanze</label>
              <input type="number" id="rooms" name="rooms" class="@error("rooms") is-invalid @enderror" required min="1" max="10">
            </div>
            {{-- /rooms --}}

            {{-- beds --}}
            <div>
              <label for="beds">Letti</label>
              <input type="number" id="beds" name="beds" class="@error("beds") is-invalid @enderror" required min="1" max="10">
            </div>
            {{-- /beds --}}

            {{-- bathrooms --}}
            <div>
              <label for="bathrooms">Bagni</label>
              <input type="number" id="bathrooms" name="bathrooms" class="@error("bathrooms") is-invalid @enderror" required min="1" max="10">
            </div>
            {{-- /bathrooms --}}
          
          </div>
          @error("square_feet")
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          @error("rooms")
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          @error("beds")
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          @error("bathrooms")
            <span class="invalid-feedback d-block" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror

          {{-- main image --}}
          <label for="main-img-create">Carica Immagine principale</label>
          <input type="file" id="main-img-create" name="poster_img" class="@error("poster_img") is-invalid @enderror">
          @error("poster_img")
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          {{-- /main image --}}

          {{-- other images --}}
          <label for="images">Carica fino ad altre 4 immagini</label>
          <input type="file" id="images" name="images[]" multiple class="@error("images") is-invalid @enderror">
          @error("images")
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          {{-- /other images --}}
          
          {{-- services --}}
          <label>Quali servizi metti a disposizione?</label>
          <div id="services-container">
            @foreach ($services as $service)
              <input type="checkbox" id="{{ $service -> type }}" name="services[]" value="{{$service -> id}}" class="@error("services") is-invalid @enderror">
              <label for="{{ $service -> type }}">{{ $service -> type }}</label>
            @endforeach
          </div>
          @error("services")
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          {{-- /services --}}

          <button id="create-aptm-btn">Aggiungi appartamento</button>
        </div>
      </form>
    </div>
    <div class="col-lg-6 myBgCreate d-md-none d-lg-block"> 
    </div>
  </div>
</div>
@endsection
