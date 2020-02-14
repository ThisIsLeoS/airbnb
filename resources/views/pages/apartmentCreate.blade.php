@extends('layouts.base')

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-6">
            <form id="create-aptm-form" action="{{ route("apartment.store", Auth::user()->id) }}" method="POST">
                @csrf
                @method("POST")
                <h1>
                    Ciao {{ Auth::user()->name }}! Crea un annuncio per il tuo appartamento.
                </h1>
                <ol>
                    <li>
                         <label for="description">Inserisci una breve descrizione del tuo appartamento</label>
                        <input type="text" id="description" name="description">
                    </li>
                    <li>
                        Indirizzo dell'appartamento
                        <ul>
                            <li>
                                <label for="streetName">Via</label>
                                <input type="text" id="streetName" name="address">
                            </li>
                            <li>
                                <label for="streetNumber">Numero civico</label>
                                <input type="text" id="streetNumber" name="streetNumber">
                            </li>
                            <li>
                                <label for="municipality">Città</label>
                                <input type="text" id="municipality" name="municipality">
                            </li>
                            <li>
                                <label for="postalCode">CAP</label>
                                <input type="text" id="postalCode" name="postalCode">
                            </li>
                            <li>
                                <label for="countrySubdivision">Regione</label>
                                <input type="text" id="countrySubdivision" name="countrySubdivision">
                            </li>
                            <li>
                                <label for="coutryCode">Paese (IT/ITA o FR/FRA ecc.)</label>
                                <input type="text" id="coutryCode" name="coutryCode">
                            </li>  
                         </ul>
                    </li>
                    <li>
                        <label for="square-feet">Metri quadri</label>
                        <input type="number" id="square-feet" name="square_feet">
                    </li>
                    <li>
                        <label for="rooms">Stanze</label>
                        <input type="number" id="rooms" name="rooms">
                    </li>
                    <li>
                        <label for="beds">Letti</label>
                        <input type="number" id="beds" name="beds">
                    </li>
                    <li>
                        <label for="bathrooms">Bagni</label>
                        <input type="number" id="bathrooms" name="bathrooms">
                    </li>
                    <li>
                        Quali servizi metti a disposizione?
                        <ul>
                            <li>
                                <input type="checkbox" id="wifi" name="services[]" value="wifi">
                                <label for="wifi">Wi-Fi</label>
                            </li>
                            <li>
                                <input type="checkbox" id="parking-slot" name="services[]" value="parking-slot">
                                <label for="parking-slot">posto auto</label>
                            </li>
                            <li>
                                <input type="checkbox" id="swimming-pool" name="services[]" value="swimming-pool">
                                <label for="swimming-pool">piscina</label>
                            </li>
                            <li>
                                <input type="checkbox" id="sauna" name="services[]" value="sauna">
                                <label for="sauna">sauna</label>
                            </li>
                            <li>
                                <input type="checkbox" id="sea-view" name="services[]" value="sea-view">
                                <label for="sea-view">vista mare</label>
                            </li>
                            <li>
                                <input type="checkbox" id="reception" name="services[]" value="reception">
                                <label for="reception">reception</label>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <label for="photo">Aggiungi una foto</label>
                        <input type="file" id="photo" name="photo">
                    </li>
                </ol>
                <button id="create-aptm-btn">Aggiungi appartamento</button>
            </form>
        </div>  
    </div>
</div>
@endsection
