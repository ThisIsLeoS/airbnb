@extends('layouts.base')
@section('content')
    
<div class="container-fluid">
  
  @if (count($apartmentsToShow) > 0)
  <h2 class="text-center">"Abbiamo trovato {{ count($apartmentsToShow) }} risultati per la tua ricerca"</h2>
  <div class="row">
    <div class="col-12 myCards">
          
      @foreach ($apartmentsToShow as $apartment)
      {{ $distance}}
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src={{$apartment -> poster_img}} alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Test</h5>
          <p class="card-text"> {{$apartment->description}}</p>
          <a href="{{route("apartment.show",$apartment-> id)}}" class="btn btn-primary">Vai a pagina dettaglio</a>
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

