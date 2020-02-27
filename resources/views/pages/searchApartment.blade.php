@extends('layouts.base')
@section('content')
<style>
 .carousel-control-prev, .carousel-control-next{
      top:50% !important;
      height:20px;
      padding:0.5%;
      background:grey;
  }

  a{
      color:black;
      text-decoration: none;
  }

  a:hover{
      text-decoration: none;
      color:black;
  }

  .myH5{
      color:grey;
      background:white;
      padding:10px;
      border-radius:10px;
  }

  .card-body{
      height: 150px;
  }

  .carousel-control-prev:active,.carousel-control-next:active{
      background:#808080;
  }

  .carousel-control-next-icon,.carousel-control-prev-icon{
      background-image: none;
  }

  /*
  .carousel-control-next {
      left: 100%;
  }
   */
  @media (min-width: 768px) {

      .carousel-inner .carousel-item-right.active,
      .carousel-inner .carousel-item-next {
          transform: translateX(50%);
      }

      .carousel-inner .carousel-item-left.active,
      .carousel-inner .carousel-item-prev {
          transform: translateX(-50%);
      }
  }

  /* large - display 3 */
  @media (min-width: 992px) {

      .carousel-inner .carousel-item-right.active,
      .carousel-inner .carousel-item-next {
          transform: translateX(33%);
      }

      .carousel-inner .carousel-item-left.active,
      .carousel-inner .carousel-item-prev {
          transform: translateX(-33%);
      }
  }

  @media (max-width: 768px) {
      .carousel-inner .carousel-item>div {
          display: none;
      }

      .carousel-inner .carousel-item>div:first-child {
          display: block;
      }
  }

  .carousel-inner .carousel-item.active,
  .carousel-inner .carousel-item-next,
  .carousel-inner .carousel-item-prev {
      display: flex;
  }

  .carousel-inner .carousel-item-right,
  .carousel-inner .carousel-item-left {
      transform: translateX(0);
  }
</style>

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

  <div id="found-apartments">
      {!! $html !!}
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

  function printApartments(url) {
    $("#found-apartments").empty();
    var servicesArray = [];
    $("input[name='services[]']:checked").each(function(){
      servicesArray.push($(this).val());
    });
    $.ajax({
      "url": url,
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
        console.log(data);
        $("#found-apartments").append(data);
        // console.log('data',data[0].apartment['title']);
        // printAptFiltered(data);
      },
      "error": function (iqXHR, textStatus, errorThrown) {
        alert(
          "iqXHR.status: " + iqXHR.status + "\n" +
          "textStatus: " + textStatus + "\n" +
          "errorThrown: " + errorThrown
        );
      }
    });
  }

  $("#advSearchBtn").click(function(event) {
    printApartments("{{ route('apartment.adv.search') }}");
  });

  $('#myCarouselAptPlus').carousel({
      interval: 3000
  })

  $('.carousel .carousel-item').each(function() {
      var minPerSlide = 4;
      var next = $(this).next();
      if (!next.length) {
          next = $(this).siblings(':first');
      }
      next.children(':first-child').clone().appendTo($(this));

      for (var i = 0; i < minPerSlide; i++) {
          next = next.next();
          if (!next.length) {
              next = $(this).siblings(':first');
          }

          next.children(':first-child').clone().appendTo($(this));
      }
  });

</script>


@endsection
