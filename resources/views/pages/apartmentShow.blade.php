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
            @foreach ($apartment -> services as $service)
            {{$service -> type}}
        @endforeach
        </div>
        <div class="col-6">
            il Proprietario di questo appartamento è {{$apartment -> user -> name}}
        </div>
    </div>
</div>


@endsection