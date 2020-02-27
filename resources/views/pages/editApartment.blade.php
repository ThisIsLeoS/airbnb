@extends('layouts.base')

@section('content')
<style>
/*   main{
    height:80vh;
    background:url("/images/CreateApt/updApt.png");
    background-repeat: no-repeat;
    background-position: right;
    background-attachment: fixed;
  } */
</style>
<div class="container-fluid">
  <h3 class="text-center">
        Ciao {{ Auth::user()->name }} ! Modifica il tuo appartamento.
    </h3>
    <div class="row">
      <div class="col-lg-6">
        
        <form id="update-aptm-form"  action="{{ route('apartment.update', $apartment -> id ) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('POST')
          <div class="d-flex flex-column">
          
            <label for="title">Titolo</label>
            <input type="text" name="title" value="{{ $apartment -> title }}">
            <label for="description">Descrizione</label>
            <input type="text" name="description" value="{{ $apartment -> description }}">
            <label for="address">Indirizzo dell'appartamento</label>
            <input id="updateAddress"" type="text" id="address" name="address" value="{{ $apartment -> address }}">
            <label for="rooms">Stanze</label>
            <input type="number" name="rooms" value="{{ $apartment -> rooms }}">
            <label for="beds">Letti</label>
            <input type="number" name="beds" value="{{ $apartment -> beds }}">
            <label for="bathrooms">Bagni</label>
            <input type="number" name="bathrooms" value="{{ $apartment -> bathrooms }}">
            <label for="square_feet">Metri quadri</label>
            <input type="number" name="square_feet" value="{{ $apartment -> square_feet }}">
            Quali servizi metti a disposizione ? 
            <div>
              @foreach ($services as $service)
                  <input name="services[]" type="checkbox" value="{{$service -> id}}"  @if ($apartment -> services() -> find($service -> id))
                  checked  @endif>{{$service -> type}}
              @endforeach
            </div>
            
            <input type="file" name="poster_img" value="{{ $apartment -> poster_img }}">
            
          
              @if ($apartment -> poster_img == "https://source.unsplash.com/random/1920x1280/?apartment")
                <div class="mt-2 mb-2" id="testupdate" 
                  style="background:url('https://source.unsplash.com/random/1920x1280/?apartment');
                    width:250px;
                    height:250px;
                    background-size: cover; 
                    background-position:center;">
              @elseif(!$apartment -> poster_img == null)
                <div class="mt-2 mb-2" id="testupdate" 
                  style="background:url('/images/AptImg/{{$apartment->id."/".$apartment -> poster_img}}'); 
                    width:250px;
                    height:250px;
                    background-size:cover;
                    background-position:center;">
              @endif 
            </div>
            <button id="update-aptm-btn mt-3" >Modifica Appartamento</button>
        </div>
        </form>

      </div>
      <div class="col-lg-6 myBgCreateUpd d-md-none d-lg-block" >
            
        </div>
    </div>
</div>


  

@endsection
