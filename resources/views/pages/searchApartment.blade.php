@extends('layouts.base')
@section('content')
    
<div class="container-fluid">
  
  @if (count($apartmentsAndDistances) > 0)
  <h2 class="text-center">"Abbiamo trovato {{ count($apartmentsAndDistances) }} risultati per la tua ricerca"</h2>
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
        uasort($apartmentsAndDistances, "compare_by_int_key");
      @endphp 

      @foreach ($apartmentsAndDistances as $aptAndDist)
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src={{$aptAndDist["apartment"] -> poster_img}} alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Test</h5>
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

