

<h4><strong> Alloggi Airbnb Plus</strong></h4>
  <h5>Una selezione di alloggi verificati per qualità e design.</h5>
  <div class="col-12 myCards sponsorApt mb-3">
    @php
        $numbOfapt=0;
    @endphp
    @foreach ($sponsorships as $sponsorship)
      @foreach ($sponsorship->apartments as $apartment)
        @php
          $numbOfapt++;
        @endphp
        @if ($numbOfapt <= 5)
          <div class="card" style="width: 18rem;">
            @if ($apartment -> poster_img == "https://source.unsplash.com/random/1920x1280/?apartment")
              <img class="card-img-top" src={{$apartment -> poster_img}} alt="Card image cap">
            @else
              <img class="card-img-top" src="{{URL::to('/images/AptImg/'.$apartment -> poster_img)}}" alt="Card image cap">
            @endif
            <div class="card-body">
            <h5 class="card-title">{{$apartment -> title}}</h5>
            <p class="card-text"> {{$apartment->id}}</p>
            <p class="card-text"> {{$apartment->description}}</p>
            <a href="{{route("apartment.show",$apartment-> id)}}" class="btn btn-primary">Vai a pagina dettaglio</a>
            </div>
          </div>
        @else
          @break
        @endif
      @endforeach
    @endforeach
  </div>
@if (count($filteredAptsAndDists) > 0)
  <h4><strong> "Abbiamo trovato {{ count($filteredAptsAndDists) }} risultati per la tua ricerca"</strong></h4>
  <div  class="row">
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
          @if ($aptAndDist["apartment"] -> poster_img == "https://source.unsplash.com/random/1920x1280/?apartment")
            <img class="card-img-top" src={{$aptAndDist["apartment"] -> poster_img}} alt="Card image cap">
          @else
            <img class="card-img-top" src="{{URL::to('/images/AptImg/'.$aptAndDist["apartment"] -> poster_img)}}" alt="Card image cap">
          @endif
          <div class="card-body">
            <h5 class="card-title">Test</h5>
            <p class="card-text"> {{$aptAndDist["apartment"]->id}}</p>
            <p class="card-text"> {{$aptAndDist["apartment"]->description}}</p>
            <p class="card-text"> {{$aptAndDist["distance"]}}</p>
            <a href="{{route("apartment.show",$aptAndDist["apartment"]-> id)}}" class="btn btn-primary">Vai a pagina dettaglio</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@else
  <h4><strong> "Non abbiamo trovato risultati per la tua ricerca"</strong></h4>
@endif