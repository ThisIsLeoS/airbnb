@extends('layouts.base')

@section('content')

  <form id="update-aptm-form"  action="{{ route('apartment.update', $apartment -> id ) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <label for="title">Titolo</label>
    <input type="text" name="title" value="{{ $apartment -> title }}"><br>
    <label for="description">Descrizione</label>
    <input type="text" name="description" value="{{ $apartment -> description }}"><br>
    <label for="address">Indirizzo dell'appartamento</label>
    <input id="updateAddress"" type="text" id="address" name="address" value="{{ $apartment -> address }}"><br>
    <label for="rooms">Stanze</label>
    <input type="number" name="rooms" value="{{ $apartment -> rooms }}"><br>
    <label for="beds">Letti</label>
    <input type="number" name="beds" value="{{ $apartment -> beds }}"><br>
    <label for="bathrooms">Bagni</label>
    <input type="number" name="bathrooms" value="{{ $apartment -> bathrooms }}"><br>
    <label for="square_feet">Metri quadri</label>
    <input type="number" name="square_feet" value="{{ $apartment -> square_feet }}"><br>
    <div>
      @foreach ($services as $service)
          <input name="services[]" type="checkbox" value="{{$service -> id}}"  @if ($apartment -> services() -> find($service -> id))
          checked  @endif>{{$service -> type}}
      @endforeach
    </div>
    
    <input type="file" name="poster_img" value="{{ $apartment -> poster_img }}"><br>
    

      @if ($apartment -> poster_img == "https://source.unsplash.com/random/1920x1280/?apartment")
        <div id="testupdate" 
          style="background:url('https://source.unsplash.com/random/1920x1280/?apartment');
            width:250px;
            height:250px;
            background-size: cover; 
            background-position:center;">
      @elseif(!$apartment -> poster_img == null)
        <div id="testupdate" 
          style="background:url('/images/AptImg/{{$apartment->id."/".$apartment -> poster_img}}'); 
            width:250px;
            height:250px;
            background-size:cover;
            background-position:center;">
      @endif 
    </div>
    <button id="update-aptm-btn" >Modifica </button>
  </form>

  

@endsection
