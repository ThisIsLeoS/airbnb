@extends('layouts.base')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-12  mt-5 mb-5 col-md-8 offset-md-2">
      <form  action="{{route('apartment.adv.search')}}" id="searchByFiltersForm" class="range-field " method="post">
        @csrf
        @method("POST")
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Aggiungi filtri per la tua ricerca</h3>
          </div>
          <div class="d-flex flex-column p-3">
            <div class="text-center">
              <label for="rooms">Numero Stanze</label>
              <input type="number" id="rooms" name="rooms" min="1" max="4">
              <label for="beds">Numero Letti</label>
              <input type="number" id="beds" name="beds" min="1" max="4">
              <span class="text-center ml-5 m">Raggio di ricerca: <span class="ml-2" id="valOfRadius"></span> km</span>
              <input id="radius" name="radius" type="range" min="1" max="200" value="50" class="slider ml-2">
            </div>
            <div class="mt-3 text-center">
              <p>Seleziona i servizi che desideri:</p>
              <input type="checkbox" id="wifi" name="services[]" value="wifi">
              <label for="wifi">Wi-Fi</label>
              <input type="checkbox" id="parking-slot" name="services[]" value="parking_slot">
              <label for="parking-slot">posto auto</label>
              <input type="checkbox" id="swimming-pool" name="services[]" value="swimming_pool">
              <label for="swimming-pool">piscina</label>
              <input type="checkbox" id="sauna" name="services[]" value="sauna">
              <label for="sauna">sauna</label>
              <input type="checkbox" id="sea-view" name="services[]" value="sea_view">
              <label for="sea-view">vista mare</label>
              <input type="checkbox" id="reception" name="services[]" value="reception">
              <label for="reception">reception</label>
            </div>
            <button id="advSearchBtn" type="button" class="btn btn-primary">Filtra</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <h4><strong> Alloggi Airbnb Plus</strong></h4>
  <h5>Una selezione di alloggi verificati per qualità e design.</h5>

  <div class="col-12 myCards sponsorApt mb-3">{{-- Qui andranno sempre e cmq tutti gli appartamenti sponsorizzati a prescindere dai filtri imposti dalla ricerca , sono quindi elementi statici  --}}
  </div>
  @if (count($filteredAptsAndDists) > 0)
  <h4><strong> "Abbiamo trovato {{ count($filteredAptsAndDists) }} risultati per la tua ricerca"</strong></h4>
  <div id="deleteHtml" class="row">
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

      {{-- HBars --}}

      <script id="templateHb" type="text/x-handlebars-template">
          <div class="test">
            <p>@{{id}}</p>
            <p>@{{title}}</p>
            <p>@{{distance}}</p>
          </div>
      </script>
      <div class="aptFilteredOutput">

      </div>
      {{-- HBars --}}
      @foreach ($filteredAptsAndDists as $aptAndDist)
        <div class="card" style="width: 18rem;">
          @if ($aptAndDist["apartment"] -> poster_img == "https://source.unsplash.com/random/400x250/?apartment")
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
      @else
      <h4><strong> "Non abbiamo trovato risultati per la tua ricerca"</strong></h4>
      @endif
    </div>
  </div>
</div>

<script>
  var slider = document.getElementById("radius");
  var output = document.getElementById("valOfRadius");
  output.innerHTML = slider.value;
    slider.oninput = function() {
  output.innerHTML = this.value;
  }

  function printAptFiltered(data) {
// PRIMA PROVA
    // var elem = data[0];
    // console.log('elem',elem);
    var target = $(".aptFilteredOutput");
    var template = $("#templateHb").html();
    var compiled = Handlebars.compile(template);
    for(var i = 0; i<data.length;i++){
      var apts = data[i].apartment;
      var dist = data[i];
      console.log('apts',apts);
      console.log('dist',dist);
      var compiledApt = compiled(apts)
      var compiledDist = compiled(dist);
      target.append(compiledApt,compiledDist);
    }


    /* SECONDA PROVA questa funziona se dall'altra parte usi la compact ma non stampa in pagina
    var sorgente = $("#templateHb").html();
    var template = Handlebars.compile(sorgente);
    var target = $("#aptFilteredOutput").html("");

    var apt, html;

    var apts = data.filteredAptsAndDists;
    console.log(apts)

    apts.forEach(oggetto => {

        apt = {
            title: oggetto.title
        }

        html = template(apt);
        console.log(html)

        target.append(html);

    });
     */
  }




  $("#advSearchBtn").click(function(event) {
    console.log("prova");
    var servicesArray = [];
    $("input[name='services[]']:checked").each(function(){
      servicesArray.push($(this).val());
    });
    $.ajax({
      "url": "{{ route('apartment.adv.search') }}",
      "method": "POST",
      "data": {
      "rooms": $("input[name='rooms']").val(),
      "beds": $("input[name='beds']").val(),
      "radius": $("input[name='radius']").val(),
      "services": servicesArray
      },
      "headers": {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      "success": function (data) {
      /* console.log(data); */
        // console.log('data',data[0].apartment['title']);
        printAptFiltered(data);
      },
      "error": function (iqXHR, textStatus, errorThrown) {
        alert(
        "iqXHR.status: " + iqXHR.status + "\n" +
        "textStatus: " + textStatus + "\n" +
        "errorThrown: " + errorThrown
        );
      }
    });
  });
</script>
@endsection
