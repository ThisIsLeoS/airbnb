@extends('layouts.base')

@section("content")
  <div class="container-fluid ">
    <div class="card" style="width: 20rem;">
      <div class="card-body card_center">

        <div class="card-body">
        <form action="{{route("user.set.image")}}" method="post" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <input type="file" name="profile_img" >
            <input type="submit" value="Carica Immagine">
          </form>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="mt-5 ">
        <h1 class="display-4">Ciao {{ $user->name }}</h1>
        <a href="#" class="btn btn-dark">Modifica il profilo </a>

      </div>
    </div>
  </div>
  <div >
    <h1>Ciao {{ $user->name }}</h1>
    <a href="#">Modifica il profilo </a>
  </div>
  <div >

    <img src="{{asset('images/UserProfileImg/'.Auth::user() -> profile_img)}}" alt="">




      <a href="{{ route('userApartment.show',$user -> id) }}">I miei appartamenti({{ $user -> apartments() -> count()}}) </a>

  </div>


@endsection
