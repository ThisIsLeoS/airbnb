@extends('layouts.base')

@section("content")
<div class="container-fluid">
    <div class="row p-2">
        <div class="col-6 ms_img noGutter border border-dark">
            <img src="{{asset('images/ShowApt/img1.jpg')}}" alt="">
        </div>
        <div class="col-6 ms_img ">
            <div class="row ">
                <div class="col-6 ms_img noGutter border border-dark">
                    <img src="{{asset('images/ShowApt/img2.jpg')}}" alt="">
                </div>
                <div class="col-6 ms_img noGutter border border-dark">
                    <img src="{{asset('images/ShowApt/img3.jpg')}}" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-6 ms_img noGutter border border-dark">
                    <img src="{{asset('images/ShowApt/img4.jpg')}}" alt="">
                </div>
                <div class="col-6 ms_img noGutter border border-dark">
                    <img src="{{asset('images/ShowApt/img5.jpg')}}" alt="">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container-fluid">
    <h1>Titolo stanza </h1>
    <div class="row">
        <div class="col-6">
          <h4>{{$apartment -> description}}</h4>
            <div class="row detail_apt">
                <div class="col-6">
                    <i class="fas fa-building"></i><p>Stanze disponibili : {{$apartment -> rooms}}</p>
                </div>
                <div class="col-6">
                    <i class="fas fa-ruler-combined"></i><p>Dimensione : {{$apartment -> square_feet}} mq<sup>2</sup></p>
                </div>
                <div class="col-6">
                    <i class="fas fa-bed" style="color:black"></i> <p>Letti disponibili : {{$apartment -> beds}}</p>
                </div>
                <div class="col-6">
                    <i class="fas fa-toilet-paper"></i><p>Bagni disponibili : {{$apartment -> bathrooms}}</p>
                </div>
            </div>
            Servizi Aggiuntivi :
            <ul>
                @foreach ($apartment -> services as $service)
                <li>{{$service -> type}}</li>
                @endforeach
            </ul>
        </div>
       {{-- Controllo prima di tutto se è un utente loggato --}} 
        @if (Auth::user())
          {{-- Una volta accertatomi che è un utente loggato controllo se quell'appartamento è effettivamente suo --}} 
          @if (Auth::user() -> id == $apartment -> user -> id)
            <div class="col-6">
              il Proprietario di questo appartamento sei tu
            </div>
            {{-- se non è suo mostro il nome del proprietario --}}
          @else
            <div class="col-6">
              il Proprietario di questo appartamento è {{$apartment -> user -> name}}
            </div> 
          @endif
        {{-- Se siamo di fronte ad un GUEST allora mostro tutto normalmente --}}    
        @else
          <div class="col-6">
            il Proprietario di questo appartamento è {{$apartment -> user -> name}}
          </div> 
        @endif
        
        <div class="col-12">
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
         @if(session()->has('message'))
            <div class="alert alert-success my_message">
                {{ session()->get('message') }}
            </div>
        @endif
        {{-- Controllo sempre se l'utente è loggato --}}
        @if (Auth::user())
            {{-- Controllo se l'utente loggato è anche proprietario e in quel caso mostro --}}
           @if (Auth::user() -> id == $apartment -> user -> id)
               <div class="text-center">
                  <a href="{{ route('userApartment.show',Auth::user() -> id) }}" class="btn btn-primary btn-rounded mb-4">Vai a tutti i tuoi appartamenti</a>
              </div>
            @else
            {{-- FORM utente loggato NON PROPRIETARIO --}}
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
          <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalContactForm">Ti Piace l'appartamento ? Invia un messaggio al proprietario</a>
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
                  {{-- @if(Auth::user())
                    <div class="md-form mb-5">
                      <i class="fas fa-envelope prefix grey-text"></i>
                       
                        <input type="email" id="form29" name="sender"  value={{Auth::user() ->email}} class="form-control validate">
                        <label data-error="wrong" data-success="right" for="sender">La Tua Mail</label>
                    </div>
                  @else --}}
                  <div class="md-form mb-5">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="email" id="form29" name="sender"  class="form-control validate">
                    <label data-error="wrong" data-success="right" for="sender">La Tua Mail</label>
                  </div>
                  {{-- @endif --}}
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
       {{--  <form action="{{route("message.apartment.create", $apartment ->id)}}" method="post">
        @csrf
        @method("POST")
        <label for="sender">Sender:</label><br>
        <input  type="text" name="sender"><br><br>
        <label for="text">Body:</label><br>
        <input type="text" name="text"><br><br>
        <button type="submit" name="submit" value="ADD">Invia Messaggio</button>
        </form>--}}
        </div> 
        {{-- @endif --}}
    </div>
</div>

{{-- <script type="text/javascript">
console.log(typeahead())
var path="{{route('autocomplete.sender')}}";
$("input.typeahead").typeahead({
    source:function(query,process){
        return $.get(path,{query:sender},function(data){
            return process(data);
        })
    }
});

</script>
 --}}

@endsection
