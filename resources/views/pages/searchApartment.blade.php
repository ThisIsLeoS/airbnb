@extends('layouts.base')
@section('content')
    
<div class="container-fluid">
  <form action="{{route('apartment.adv.search')}}" class="range-field" method="post">
    @csrf
    @method("POST")
  <label for="rooms">Numero Stanze</label>
  <input type="number" id="rooms" name="rooms" min="1" max="4">
  <label for="beds">Numero Letti</label>
  <input type="number" id="beds" name="beds" min="1" max="4"><br>
  <label for="radius">Raggio</label>
  <input type="number" id="radius" name="radius" min="1" max="500000000"><br>
  <ul>
    <li>
        <input type="checkbox" id="wifi" name="services[]" value="wifi">
        <label for="wifi">Wi-Fi</label>
    </li>
    <li>
        <input type="checkbox" id="parking-slot" name="services[]" value="parking_slot">
        <label for="parking-slot">posto auto</label>
    </li>
    <li>
        <input type="checkbox" id="swimming-pool" name="services[]" value="swimming_pool">
        <label for="swimming-pool">piscina</label>
    </li>
    <li>
        <input type="checkbox" id="sauna" name="services[]" value="sauna">
        <label for="sauna">sauna</label>
    </li>
    <li>
        <input type="checkbox" id="sea-view" name="services[]" value="sea_view">
        <label for="sea-view">vista mare</label>
    </li>
    <li>
        <input type="checkbox" id="reception" name="services[]" value="reception">
        <label for="reception">reception</label>
    </li>
</ul>

 

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  
  @if (count($filteredAptsAndDists) > 0)
  <h2 class="text-center">"Abbiamo trovato {{ count($filteredAptsAndDists) }} risultati per la tua ricerca"</h2>
  <div class="row">
    <div class="col-12 myCards">
      @php
        // l'array viene ordinato in base alla distanza
        function compare_by_int_key($a, $b) {
        if ($a['distance'] == $b['distance']) {
          return 0;
        }
          return ($a['distance'] < $b['distance']) ? -1 : 1;
        }
        uasort($filteredAptsAndDists, "compare_by_int_key");
      @endphp 

      @foreach ($filteredAptsAndDists as $aptAndDist)
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src={{$aptAndDist["apartment"] -> poster_img}} alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Test</h5>
            <p class="card-text"> {{$aptAndDist["apartment"]->id}}</p>
            <p class="card-text"> {{$aptAndDist["apartment"]->description}}</p>
            <p class="card-text"> {{$aptAndDist["distance"]}}</p>
            <a href="{{route("apartment.show",$aptAndDist["apartment"]-> id)}}" class="btn btn-primary">Vai a pagina dettaglio</a>
          </div>
        </div>     
      @endforeach
      @else
      <h2 class="text-center">"Non abbiamo trovato risultati per la tua ricerca"</h2>
      @endif
    </div>
  </div>
</div>

@endsection

