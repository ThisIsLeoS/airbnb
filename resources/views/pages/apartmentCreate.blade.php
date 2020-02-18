@extends('layouts.base')

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12">
            <form id="create-aptm-form" action="{{ route("apartment.store", Auth::user()->id) }}" method="POST">
                @csrf
                @method("POST")
                <h3 class="text-center">
                    Ciao {{ Auth::user()->name }}! Crea un annuncio per il tuo appartamento.
                </h3>
                <div class="d-flex flex-column">
                    <label for="title">Inserisci una breve titolo</label>
                    <input type="text" id="title" name="title">
                    <label for="description">Inserisci una breve descrizione del tuo appartamento</label>
                    <input type="text" id="description" name="description">
                    <label for="address">Indirizzo dell'appartamento</label>
                    <input type="text" id="address" name="address">
                    <label  for="square-feet">Metri quadri</label>
                    <input type="number" min="25" max="100" id="square-feet" name="square_feet">
                    <label for="rooms">Stanze</label>
                    <input type="number" id="rooms" min="1" max="4" name="rooms">
                    <label for="beds">Letti</label>
                    <input type="number" id="beds" min="1" max="4" name="beds">
                    <label for="bathrooms" >Bagni</label>
                    <input type="number" id="bathrooms" min="1" max="2" name="bathrooms">
                    Quali servizi metti a disposizione?
                    {{-- <select name="services[]" class="custom-select" multiple> --}}
                    <div>
                        
                       @foreach ($services as $service)
                            <input name="services[]" type="checkbox" value="{{$service -> id}}">{{$service -> type}}
                        @endforeach
                        </div>

                        
                        <button id="create-aptm-btn">Aggiungi appartamento</button>
                    </form>
                </div>  
    </div>
</div>
@endsection
