@extends('layouts.base')

@section("content")
@if(session()->has('message'))
            <script type="text/javascript">
              $(document).ready(function() {
              $('#popupmodal').modal();
            });
          </script>
            <div class="modal fade" id="popupmodal" role="dialog" aria-hidden="true">
              <div class="modal-dialog" style="background:white;border-radius:10px" role="document">
                <div class="modal-header" style="border-radius:10px">
                  
                  </button>
                   <div class="modal-body">
                    {{ session()->get('message') }}
                  </div>
                  <div class="modal-footer" style="border-top:none;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                  </div>
                </div>
              </div>
                
            </div>
        @endif
<div class="container-fluid">
    <div class="row p-2 min_height">
      
        <div class="col-12 col-sm-6 ms_img noGutter border border-dark">
          @if ($apartment -> poster_img == "https://source.unsplash.com/random/1920x1280/?apartment")
            <img class="img-fluid" src="{{$apartment->poster_img}}" alt="">
          @elseif($apartment -> poster_img == NULL)
            <img class="img-fluid" src="{{URL::to('images/noUpload.png')}}" alt="">
          @else
            <img class="img-fluid" src="{{URL::to('/images/AptImg/'.$apartment->id."/".$apartment -> poster_img)}}" alt="Card image cap">
          @endif
        </div>
        <div class="col-6 ms_img d-none d-sm-block">
            <div class="row myHeight">
                <div class="col-6 ms_img noGutter border border-dark">
                  
                    @if ($apartment -> images[0] -> path === "noUpload")
                      <img  src="{{URL::to('images/noUpload.png')}}" alt="">
                    @elseif($apartment -> images[0] -> path == "/images/ShowApt/img1.jpg")
                      <img src="{{asset('images/ShowApt/img1.jpg')}}" alt="">
                    @else
                      <img src="{{asset('images/AptImg/'.$apartment->id.'/others/'.$apartment->images[0]->path)}}" alt="">
                    @endif
                    
                </div>
                <div class="col-6 ms_img noGutter border border-dark">
                    @if ($apartment -> images[1] -> path === "noUpload")
                      <img  src="{{URL::to('images/noUpload.png')}}" alt="">
                    @elseif($apartment -> images[1] -> path == "/images/ShowApt/img2.jpg")
                      <img src="{{asset('images/ShowApt/img2.jpg')}}" alt="">
                    @else
                      <img src="{{asset('images/AptImg/'.$apartment->id.'/others/'.$apartment->images[1]->path)}}" alt="">
                    @endif
                </div>
            </div>
            <div class="row myHeight">
                <div class="col-6 ms_img noGutter border border-dark">
                    @if ($apartment -> images[2] -> path === "noUpload")
                      <img  src="{{URL::to('images/noUpload.png')}}" alt="">
                    @elseif($apartment -> images[2] -> path == "/images/ShowApt/img3.jpg")
                      <img src="{{asset('images/ShowApt/img3.jpg')}}" alt="">
                    @else
                      <img src="{{asset('images/AptImg/'.$apartment->id.'/others/'.$apartment->images[2]->path)}}" alt="">
                    @endif
                </div>
                <div class="col-6 ms_img noGutter border border-dark">
                    @if ($apartment -> images[3] -> path === "noUpload")
                      <img  src="{{URL::to('images/noUpload.png')}}" alt="">
                    @elseif($apartment -> images[3] -> path == "/images/ShowApt/img4.jpg")
                      <img src="{{asset('images/ShowApt/img4.jpg')}}" alt="">
                    @else
                      <img src="{{asset('images/AptImg/'.$apartment->id.'/others/'.$apartment->images[3]->path)}}" alt="">
                    @endif
                </div>
            </div>
        </div>
      
    </div>
</div>
<div class="container-fluid p-3">
    <h1 class="text-center">{{$apartment -> title}} </h1>
    <div class="row ">
        <div class="col-12 col-md-6">
          <h4 class="text-center">{{$apartment -> description}}</h4>
            <div class="row detail_apt">
                <div class="col-12 col-md-6 serviceApt">
                    <i class="fas fa-building"></i><p>Stanze disponibili : {{$apartment -> rooms}}</p>
                </div>
                <div class="col-12 col-md-6 serviceApt">
                    <i class="fas fa-ruler-combined"></i><p>Dimensione : {{$apartment -> square_feet}} mq<sup>2</sup></p>
                </div>
                <div class="col-12 col-md-6 serviceApt">
                    <i class="fas fa-bed" style="color:black"></i> <p>Letti disponibili : {{$apartment -> beds}}</p>
                </div>
                <div class="col-12 col-md-6 serviceApt">
                    <i class="fas fa-toilet-paper"></i><p>Bagni disponibili : {{$apartment -> bathrooms}}</p>
                </div>
            </div>
            <div class="text-center mt-3 mb-3">

              @if(count($apartment -> services) > 0)
              <span style="font-size: 1.5rem">Servizi Aggiuntivi </span> 
                <div class="text-center">
  
                  @foreach ($apartment -> services as $service)
                    <span style="font-size: 1.2rem" class="services mr-2">
                      @if ($service -> type === "wifi")
                        <i class="fas fa-wifi"></i>
                      @elseif($service -> type === "posto auto")
                        <i class="fas fa-parking"></i>
                      @elseif($service -> type === "piscina")
                        <i class="fas fa-swimming-pool"></i>
                      @elseif($service -> type === "sauna")
                        <i class="fas fa-hot-tub"></i>
                      @elseif($service -> type === "vista mare")
                        <i class="fas fa-water"></i>
                      @elseif($service -> type === "reception")
                        <i class="fas fa-concierge-bell"></i>
                      @endif
                    </span>
                  @endforeach
                </div>
              @endif
            </div>
            
        </div>
       {{-- Controllo prima di tutto se è un utente loggato --}} 
        @if (Auth::user())
          {{-- Una volta accertatomi che è un utente loggato controllo se quell'appartamento è effettivamente suo --}} 
          @if (Auth::user() -> id == $apartment -> user -> id)
            <div class="col-12 col-md-6 d-flex flex-column align-items-center">
              Il proprietario di questo appartamento sei tu
              <div>
                @if (Auth::user() -> profile_img )
                  <img class="imgUser"  src="{{asset('images/UserProfileImg/'.Auth::user() -> profile_img)}}" alt=""  data-holder-rendered="true">
                  @else
                  <img class="imgUser"  src="https://a0.muscache.com/defaults/user_pic-225x225.png?v=3" alt="">
                  @endif
              </div>
            </div>
            {{-- se non è suo mostro il nome del proprietario --}}
          @else
            <div class="col-12 col-md-6 d-flex flex-column align-items-center">
              Il proprietario di questo appartamento è {{$apartment -> user -> name}}
              <div>

                @if ($apartment -> user -> profile_img )
                  <img class="imgUser"  src="{{asset('images/UserProfileImg/'.$apartment -> user -> profile_img)}}" alt=""  data-holder-rendered="true">
                  @else
                  <img class="imgUser" src="https://a0.muscache.com/defaults/user_pic-225x225.png?v=3" alt="">
                  @endif
              </div>
            </div> 
          @endif
        {{-- Se siamo di fronte ad un GUEST allora mostro tutto normalmente --}}    
        @else
          <div class="col-12 col-md-6 d-flex flex-column align-items-center">
            Il proprietario di questo appartamento è {{$apartment -> user -> name}}
            <div>
                @if ($apartment -> user -> profile_img )
                  <img class="imgUser"  src="{{asset('images/UserProfileImg/'.$apartment -> user -> profile_img)}}" alt=""  data-holder-rendered="true">
                  @else
                  <img class="imgUser" src="https://a0.muscache.com/defaults/user_pic-225x225.png?v=3" alt="">
                @endif
              </div>
           
          </div> 
        @endif
        
        <div class="col-12 mt-5">
            <h3>Ubicazione</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi ratione iste unde aliquam, deleniti aspernatur ipsum, quae qui inventore debitis dolor possimus dolore eveniet quibusdam, corrupti necessitatibus tempora illum doloribus.</p>
            <div id='map' class='map'>
            </div>
          <!-- Replace version in the URL with desired library version -->
          <script src = "https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.45.0/maps/maps-web.min.js" > </script>
            <script>
              /* tt.setProductInfo('test_mappa', '5.45.0'); */
              var myCoord =  [{{$apartment->lon}}, {{$apartment->lat}}]
              console.log(myCoord)
              var map = tt.map({
                  key: 'PXlXaqWPf4QFvdznBmvVfmi3AMAscNRm',
                  container: 'map',
                  style: 'tomtom://vector/1/basic-main',
                  center: myCoord,
                  zoom: 8
                });
                var marker = new tt.Marker().setLngLat(myCoord).addTo(map);
                </script>
        </div>
        {{-- @if (Auth::user() -> id !== $apartment -> user -> id) --}}
            
  
            
        <div class="col-12">
         
        {{-- Controllo sempre se l'utente è loggato --}}
        @if (Auth::user())
            {{-- Controllo se l'utente loggato è anche proprietario e in quel caso mostro --}}
           @if (Auth::user() -> id == $apartment -> user -> id)
               <div class="text-center">
                  <a href="{{ route('userApartment.show',Auth::user() -> id) }}" class="btn btn-primary btn-rounded mt-4 mb-4">Vai a tutti i tuoi appartamenti</a>
              </div>
            @else
            {{-- FORM utente loggato NON PROPRIETARIO --}}
              <form class="mt-5" action="{{route("message.apartment.create", $apartment ->id)}}" method="post">
        @csrf
        @method("POST")
          <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header text-center">
                  <h4 class="modal-title w-100 font-weight-bold">Scrivici</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                  <div class="md-form mb-5">
                    <strong> TO:</strong></i>
                    <input type="text" id="form32" class="form-control validate" disabled="disabled" value="{{$apartment -> user -> email}}">
                    <label data-error="wrong" data-success="right" for="form32"></label>
                  </div>
                  <div class="md-form mb-5">
                      <i class="fas fa-envelope prefix grey-text"></i>
                      <input type="email" id="form29" name="sender"  value={{Auth::user() ->email}} class="form-control validate">
                      <label data-error="wrong" data-success="right" for="sender">La Tua Mail</label>
                    </div>
                  <div class="md-form">
                    <i class="fas fa-pencil prefix grey-text"></i>
                    <textarea type="text" id="form8" name="text" class="md-textarea form-control" rows="4"></textarea>
                    <label data-error="wrong" data-success="right" for="text">Il tuo messaggio</label>
                  </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button type="submit" name="submit" class="btn btn-unique">Invia <i class="fas fa-paper-plane-o ml-1"></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="text-center">
          <a href="" class="btn btn-primary btn-rounded mt-4 mb-4" data-toggle="modal" data-target="#modalContactForm">Ti Piace l'appartamento ? Invia un messaggio al proprietario</a>
        </div>
           @endif 
           {{-- Altrimenti se mi trovo davanti un utente guest --}}
        @else
          
        {{-- FORM GUEST --}}
        <form class="mt-5" action="{{route("message.apartment.create", $apartment ->id)}}" method="post"">
        @csrf
        @method("POST")
          <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header text-center">
                  <h4 class="modal-title w-100 font-weight-bold">Scrivici</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                  <div class="md-form mb-5">
                    <strong> TO:</strong></i>
                    <input type="text" id="form32" class="form-control validate" disabled="disabled" value="{{$apartment -> user -> email}}">
                    <label data-error="wrong" data-success="right" for="form32"></label>
                  </div>
                  <div class="md-form mb-5">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="email" id="form29" name="sender"  class="form-control validate">
                    <label data-error="wrong" data-success="right" for="sender">La Tua Mail</label>
                  </div>
                  <div class="md-form">
                    <i class="fas fa-pencil prefix grey-text"></i>
                    <textarea type="text" id="form8" name="text" class="md-textarea form-control" rows="4"></textarea>
                    <label data-error="wrong" data-success="right" for="text">Il tuo messaggio</label>
                  </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button type="submit" name="submit" class="btn btn-unique">Invia <i class="fas fa-paper-plane-o ml-1"></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="text-center">
          <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalContactForm">Ti Piace l'appartamento ? Invia un messaggio al proprietario</a>
        </div>
        @endif
        </div> 
    </div>
</div>

{{-- <form id="views-info" action="{{ route("apartment.handleViews", $apartment->id) }}" method="POST">
  @csrf
  @method("POST")
  <input id="ipAddress" type="text" name="ipAddress" hidden>
</form> --}}

    

<script>
  
  var userId = null;
  @if (Auth::user())
    @if (Auth::user() -> id == $apartment -> user -> id)
      userId = {{Auth::user()->id}};
    @endif
  @endif
  console.log(userId)
  $(document).ready(function () {
    
    $.getJSON('https://api.ipify.org?format=jsonp&callback=?', function(data) {
      var ipWrapper = JSON.stringify(data, null, 2);
      var obj = JSON.parse(ipWrapper);
      // $("#ipAddress").val(obj.ip);

      // $("#views-info").submit();
      $.ajax({
        "url": "{{ route('apartment.handleViews') }}",
        "method": "POST",
        "data": {
          "aptId": "{{ $apartment->id }}",
          "ip": obj.ip,
          "userId": userId
        },
        "headers": {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "success": function (data) {
          console.log(data);
        }
      });
    });
    
    // {
    //   "ip": "93.47.39.104"
    // }
  });
  
</script>
@endsection
