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

@php
  $numbOfapartments=0;
@endphp
@foreach ($sponsorships as $sponsorship)
  @foreach ($sponsorship->apartments as $apartment)
    @php
      $numbOfapartments++;
    @endphp
  @endforeach
@endforeach

@if ($numbOfapartments > 0)
  <h4><strong> Alloggi Airbnb Plus</strong></h4>
  <h5>Una selezione di alloggi verificati per qualità e design.</h5>
  <div class="col-10 offset-1 mt-5">
      <div class="row mx-auto my-auto">
          <div class="col-12">
          <div id="myCarouselAptPlus" class="carousel slide " data-ride="carousel">
              <div class="carousel-inner w-100" role="listbox">
                  @php
                      $numbOfapt=0;
                  @endphp
                  @foreach ($sponsorships as $sponsorship)
                      @foreach ($sponsorship -> apartments as $apartment)
                          @php
                              $numbOfapt++;
                          @endphp
                          @if ($numbOfapt == 1)

                              <div class="carousel-item active">
                                  <div class="col-lg-4 col-md-6 sponsorApt">
                                      <div class="border shadow mb-5 ">

                                          <a href="{{route("apartment.show",$apartment-> id)}}">
                                         <img class="img-fluid" src="{{$apartment -> poster_img}}">

                                         <div class="card-body p-2">
                                             <h4 class="card-title">{{$apartment -> title}}</h4>
                                             <h4 class="card-title">{{$apartment -> id}}</h4>
                                             <p class="card-text">{{$apartment-> description}}</p>

                                         </div>
                                         </a>
                                      </div>
                                  </div>
                              </div>

                          @else
                              @break
                          @endif
                      @endforeach
                  @endforeach
                  @foreach ($sponsorships as $sponsorship)
                      @foreach ($sponsorship -> apartments as $apartment)
                          @if($loop-> first) @continue @endif

                          <div class="carousel-item">
                              <div class="col-lg-4 col-md-6">
                                  <div class=" border shadow mb-5 sponsorApt">

                                      <a href="{{route("apartment.show",$apartment-> id)}}">
                                      <img class="img-fluid" src="{{$apartment -> poster_img}}">
                                      <div class="card-body p-2">
                                          <h4 class="card-title">{{$apartment -> title}}</h4>
                                          <h4 class="card-title">{{$apartment -> id}}</h4>
                                          <p class="card-text">{{$apartment-> description}}</p>
                                          {{-- <a class="btn btn-primary" href="{{route("apartment.show",$apartment-> id)}}">Visita appartamento</a> --}}
                                      </div>
                                      </a>
                                  </div>
                              </div>
                          </div>

                      @endforeach
                  @endforeach
              </div>
          </div>
          </div>
      </div>

      <a class="carousel-control-prev myTestl w-auto" href="#myCarouselAptPlus" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>

      </a>
      <a class="carousel-control-next  w-auto" href="#myCarouselAptPlus" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>

      </a>
  </div>
@endif

@php
  $numOfFiltAptsAndDists = count($filteredAptsAndDists);
  foreach ($filteredAptsAndDists as $filteredAptAndDist) {
    if ($filteredAptAndDist["apartment"] -> visibility === 0) $numOfFiltAptsAndDists--;
  }
@endphp

@if ($numOfFiltAptsAndDists > 0 )
  <h4><strong> "Abbiamo trovato {{ $numOfFiltAptsAndDists }} risultati per la tua ricerca"</strong></h4>
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
        @if($aptAndDist["apartment"] ->visibility == 1)
          <div class="card" style="width: 18rem;">
            @if ($aptAndDist["apartment"] -> poster_img == "https://source.unsplash.com/random/1920x1280/?apartment")
              <div class="my_ovFlowHid">
                <img class="card-img-top" src={{$aptAndDist["apartment"] -> poster_img}} alt="Card image cap">
              </div>
            @elseif ($aptAndDist["apartment"] -> poster_img == null)
              <div class="my_ovFlowHid">
                <img class="card-img-top" src="{{URL::to('/images/noUpload.png')}}" alt="Card image cap">
              </div>
            @else
              <div class="my_ovFlowHid">
                <img class="card-img-top" src="{{URL::to('/images/AptImg/'.$aptAndDist["apartment"]->id."/".$aptAndDist["apartment"] -> poster_img)}}" alt="Card image cap">
              </div>
            @endif
            <div class="card-body">
              <p class="card-text"> {{$aptAndDist["apartment"]->id}}</p>
              <p class="card-text"> {{$aptAndDist["apartment"]->description}}</p>
              <p class="card-text"> {{$aptAndDist["distance"]}}</p>
              <a href="{{route("apartment.show",$aptAndDist["apartment"]-> id)}}" class="btn btn-primary">Vai a pagina dettaglio</a>
            </div>
          </div>

        @endif

      @endforeach
    </div>
  </div>
@else
  <h4><strong> "Non abbiamo trovato risultati per la tua ricerca"</strong></h4>
@endif

<script>
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
