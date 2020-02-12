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
<div class="container">

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
        <div class="col-6">
            il Proprietario di questo appartamento è {{$apartment -> user -> name}}
            
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
        <div class="col-12">
         @if(session()->has('message'))
    <div class="alert alert-success my_message">
        {{ session()->get('message') }}
    </div>
  @endif
        <form action="{{route("message.apartment.create", $apartment ->id)}}" method="post">
        @csrf
        @method("POST")
        <label for="sender">Sender:</label><br>
        <input  type="text" name="sender"><br><br>
        <label for="text">Body:</label><br>
        <input type="text" name="text"><br><br>
        <button type="submit" name="submit" value="ADD">Invia Messaggio</button>
        </form>
        </div>
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
