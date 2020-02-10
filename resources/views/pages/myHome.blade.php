@extends('layouts.base')

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1534595038511-9f219fe0c979?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=680&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=80&w=1920" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1529408632839-a54952c491e5?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=680&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=80&w=1920" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1465817190882-2307152364c7?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=680&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=80&w=1920" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    

<div class="container">
  <div class="row">
    <div class="col-12 myCards">
      @foreach ($apartments as $apt)

      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src={{$apt -> poster_img}} alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Test</h5>
          <p class="card-text">{{$apt -> description}}</p>
        <a href="{{route("apartment.show",$apt-> id)}}" class="btn btn-primary">Vai a pagina dettaglio</a>
        </div>
      </div>
    
@endforeach
    </div>
  </div>
</div>
@endsection