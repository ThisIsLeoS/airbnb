@extends('layouts.base')

@section("content")
<div class="container-fluid ">
    <h3 class="text-center">
        Ciao {{ Auth::user()->name }} ! Aggiungi un nuovo appartamento.
    </h3>
    <div class="row">
        <div class="col-lg-6">
            <form id="create-aptm-form" action="{{ route("apartment.store", Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="d-flex flex-column">
                    <label for="title">Inserisci una breve titolo</label>
                    <input type="text" id="title" name="title" required maxlength="255" class="@error('title') is-invalid @enderror">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="description">Inserisci una breve descrizione del tuo appartamento</label>
                    <input type="text" id="description" name="description" required maxlength="255" class="@error('description') is-invalid @enderror">
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="address">Indirizzo dell'appartamento</label>
                    <input type="text" id="address" name="address" required maxlength="255" class="@error('address') is-invalid @enderror">
                    <div id="addressesList"></div>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label  for="square-feet">Metri quadri</label>
                    <input type="number" min="1" max="1000" id="square-feet" name="square_feet" required class="@error('square_feet') is-invalid @enderror">
                    @error('square_feet')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="rooms">Stanze</label>
                    <input type="number" id="rooms" min="1" max="10" name="rooms" class="@error('rooms') is-invalid @enderror" required>
                    @error('rooms')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="beds">Letti</label>
                    <input type="number" id="beds" min="1" max="10" name="beds" class="@error('beds') is-invalid @enderror" required>
                    @error('beds')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="bathrooms">Bagni</label>
                    <input type="number" id="bathrooms" min="1" max="10" name="bathrooms" class="@error('bathrooms') is-invalid @enderror" required>
                    @error('bathrooms')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="poster_img">Carica Immagine principale</label>
                    <input type="file" id="photo"  name="poster_img" class="@error('poster_img') is-invalid @enderror">
                    @error('poster_img')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="images" >Carica fino ad altre 4 immagini</label>
                    <input type="file" id="photos"  name="images[]" multiple class="@error('images') is-invalid @enderror">
                    @error('images')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    Quali servizi metti a disposizione?
                        <div>
                            @foreach ($services as $service)
                                <input name="services[]" type="checkbox" value="{{$service -> id}}" class="@error('services') is-invalid @enderror">{{$service -> type}}
                            @endforeach
                        @error('services')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        </div>
                    <button id="create-aptm-btn">Aggiungi appartamento</button>
                </div>
            </form>
        </div>
        <div class="col-lg-6 myBgCreate d-md-none d-lg-block" style="height:100vh">
            
        </div>
    </div>
</div>
@endsection
