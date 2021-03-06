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

<div class="container-fluid">
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
            <div class="my_ovFlowHid">
              <img class="card-img-top" src={{$apartment -> poster_img}} alt="Card image cap">
            </div>
          @elseif ($apartment -> poster_img == null)
            <div class="my_ovFlowHid">
              <img class="card-img-top" src="{{URL::to('/images/noUpload.png')}}" alt="Card image cap">
            </div>
          @else
            <div class="my_ovFlowHid">
              <img class="card-img-top" src="{{URL::to('/images/AptImg/'.$apartment->id."/".$apartment -> poster_img)}}" alt="Card image cap">
            </div>
          @endif
            <div class="card-body d-flex">
              <h4 class="card-title text-center">{{$apartment -> title}}</h4>
              <div class="d-flex flex-column align-items-center justify-content-start">
                <a href="{{ route('apartment.edit',  $apartment-> id) }}" class="m-2 btn btn-success"><i class="fas fa-pen"> Modifica appartamento </i></a>
                <a href="{{ route('user.delete.apartment',  $apartment-> id) }}" class=" m-2 btn btn-danger"><i class="fas fa-trash-alt"> Rimuovi appartamento </i></a>
                <a href="{{ route('apartment.stats', $apartment-> id ) }}" class="m-2 btn stats"><i class="fas fa-signal"> Statistiche appartamento </i></a>
                @if (count($apartment -> sponsorships) > 0)
                @foreach (DB::table("apartment_sponsorship")->where("apartment_id" ,"=" , $apartment->id) -> get() as $end_time_sponsor)
                  <a data-toggle="popover" data-placement="bottom" data-content="La sponsorizzazione terminerà il {{date('d-m-Y', strtotime($end_time_sponsor -> end_time)) }} alle {{date('H:m:s', strtotime($end_time_sponsor -> end_time)) }}"  class="m-2 btn btn-secondary"><i class="fas fa-money-check-alt"> Appartmento già sponsorizzato </i></a>
                  @endforeach
                  {{--<p class="demo"></p>
                    <script>
                    var countDownDate = new Date("{{$end_time_sponsor -> end_time }}").getTime();
                    console.log(countDownDate)

                      // Update the count down every 1 second
                      var x = setInterval(function() {

                        // Get today's date and time
                        var now = new Date().getTime();
                        
                          
                        // Find the distance between now and the count down date
                        var distance = countDownDate - now;
                          
                        // Time calculations for days, hours, minutes and seconds
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                          
                        // Output the result in an element with id="demo"
                        $(".demo").text(days + "d " + hours + "h "
                        + minutes + "m " + seconds + "s ");
                          
                        
                        
                      }, 1000);

                  </script> 
                      {{date('m-d-Y H:m:s', strtotime($end_time_sponsor -> end_time)) }}
                      
                   --}}
                @else
                  <a href="{{ route("apartment.sponsorship", $apartment->id) }}" class="m-2 btn btn-info"><i class="fas fa-money-check-alt"> Sponsorizza appartamento </i></a>
                @endif
                
                <div class="d-flex mt-1 align-items-center  justify-content-center w-100">

                  <span class="my_span mr-3">Visibilità</span>
                  <label class="switch">
                    <input data-aptId="{{$apartment->id}}" class="visibilityBtn" type="checkbox" checked id="test">
                    <span class="slider round"></span>
                  </label>
                </div>

              </div>
            </div>
          </div>

      @endforeach
    </div>
  </div>
</div>

<script>

   $('[data-toggle="popover"]').click(function(){
    $(this).popover("show");
  });
  $('[data-toggle="popover"]').mouseleave(function(){
    $(this).popover("hide");
  });

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
