@extends('layouts.base')

@section("content")
<div class="container">
  <div class="row">
    <div class="col-12 mt-3">
      <div class="card-header">
        <h4 class="m-3 text-center">Gestisci i tuoi appartamenti</h4>
      </div>
    </div>
    @if(session()->has('message'))
      <div class="alert alert-success my_message">
    {{ session()->get('message') }}
      </div>
    @endif
    <div class="col-12 myCards">
      @php
        $i = 0;

      @endphp
      @foreach ($user->apartments as $apartment)
      {{-- <img class="avatar rounded-circle" src="{{asset('images/UserProfileImg/'.Auth::user() -> profile_img)}}" alt=""  data-holder-rendered="true"> --}}
      @if ($apartment->visibility == 0)

        <div class="card inactive" style="width:21rem">
          @if ($apartment -> poster_img == "https://source.unsplash.com/random/1920x1280/?apartment")
          <img class="card-img-top my_card_height" src={{$apartment -> poster_img}} alt="Card image cap">
          @else
          <img class="card-img-top" src="{{URL::to('/images/AptImg/'.$apartment -> poster_img)}}" alt="Card image cap">
          @endif
            <div class="card-body d-flex">
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
        @else
          <div class="card" style="width:21rem">
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
          @endif


      @endforeach
    </div>
  </div>
</div>

<script>


$(document).on('click','.visibilityBtn', function(event){

  event.preventDefault();

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
