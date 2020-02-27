@extends('layouts.base')

@section("content")

<style>
  .switch {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 24px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
  height: 20px;
}



.slider:before {
  position: absolute;
  content: "";
  height: 12px;
  width: 12px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<div class="container">
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
  
  <div class="row">
    <div class="col-12 mt-3">
      <div class="card-header">
        <h4 class="m-3 text-center">Gestisci i tuoi appartamenti</h4>
      </div>
    </div>
   
    <div class="col-12 myCards">
      @php
        $i = 0;

      @endphp
      @foreach ($user->apartments as $apartment)
      {{-- <img class="avatar rounded-circle" src="{{asset('images/UserProfileImg/'.Auth::user() -> profile_img)}}" alt=""  data-holder-rendered="true"> --}}
      {{-- @if ($apartment->visibility == 0) --}}

        <div class="card apt-user-show-card {{ $apartment->visibility }}" style="width:21rem">
          @if ($apartment -> poster_img == "https://source.unsplash.com/random/1920x1280/?apartment")
          <img class="card-img-top my_card_height" src={{$apartment -> poster_img}} alt="Card image cap">
          @else
          <img class="card-img-top" src="{{URL::to('/images/AptImg/'.$apartment->id."/".$apartment -> poster_img)}}" alt="Card image cap">
          @endif
            <div class="card-body d-flex">
              <h4 class="card-title text-center">{{$apartment -> title}}</h4>
              <div class="d-flex flex-column align-items-center justify-content-start">
                <a href="{{ route('apartment.edit',  $apartment-> id) }}" class="m-2 btn btn-success"><i class="fas fa-pen"> Modifica appartamento </i></a>
                <a href="{{ route('user.delete.apartment',  $apartment-> id) }}" class=" m-2 btn btn-danger"><i class="fas fa-trash-alt"> Rimuovi appartamento </i></a>
                <a href="{{ route('apartment.stats', $apartment-> id ) }}" class="m-2 btn stats"><i class="fas fa-signal"> Statistiche appartamento </i></a>
                <a href="{{ route("apartment.sponsorship", $apartment->id) }}" class="m-2 btn btn-info"><i class="fas fa-money-check-alt"> Sponsorizza appartamento </i></a>
                <div class="d-flex justify-content-around">

                  <span >Visibilità</span>
                  <label class="switch">
                    <input data-aptId="{{$apartment->id}}" class="visibilityBtn" type="checkbox" checked id="test">
                    <span class="slider round"></span>
                  </label>
                </div>
                
              </div>
            </div>
          </div>
        {{-- @else
          <div class="card apt-user-show-card {{ $apartment->visibility }}" style="width:21rem">
            @if ($apartment -> poster_img == "https://source.unsplash.com/random/1920x1280/?apartment")
            <img class="card-img-top my_card_height" src={{$apartment -> poster_img}} alt="Card image cap">
            @else
            <img class="card-img-top" src="{{URL::to('/images/AptImg/'.$apartment -> poster_img)}}" alt="Card image cap">
            @endif
            <div class="card-body d-flex ">
              <h4 class="card-title text-center">{{$apartment -> title}}</h4>
              <div class="d-flex flex-column align-items-center justify-content-start">
                <a href="{{ route('apartment.edit',  $apartment-> id) }}" class="m-2 btn btn-success"><i class="fas fa-pen"> Modifica appartamento </i></a>
                <a href="{{ route('user.delete.apartment',  $apartment-> id) }}" class=" m-2 btn btn-danger"><i class="fas fa-trash-alt"> Rimuovi appartamento </i></a>
                <a href="{{ route('apartment.stats', $apartment-> id) }}" class="m-2 btn stats"><i class="fas fa-signal"> Statistiche appartamento </i></a>
                <a href="{{ route("apartment.sponsorship", $apartment->id) }}" class="m-2 btn btn-info"><i class="fas fa-money-check-alt"> Sponsorizza appartamento </i></a>
                <a class="visibilityBtn" data-aptId="{{$apartment->id}}" href="">Cambia visibilità</a>
              </div>
            </div>
          </div>
          @endif --}}

      @endforeach
    </div>
  </div>
</div>

<script>
/* console.log(($("#test").is(":checked")) */

$(document).on('click','.visibilityBtn', function(event){

  event.preventDefault();
  var thisEl = $(this);
  $.ajax({
      "url": "{{ route('apartment.visibility') }}",
      "method": "POST",
      "data": {
          "aptId":$(this).attr("data-aptId"),

      },
      "headers": {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      "success": function (data) {
        if (thisEl.parents(".apt-user-show-card").hasClass("inactive")) {
          thisEl.parents(".apt-user-show-card").removeClass("inactive");
          thisEl.prop("checked",true);
        }
        else {
          thisEl.parents(".apt-user-show-card").addClass("inactive");
          thisEl.prop("checked", false );
        }    
        console.log(data);
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
