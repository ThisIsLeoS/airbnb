@extends('layouts.base')

@section("content")


  <div class="container-fluid">
    <div class="row">
      <div class="col-12 myCards">
  @foreach ($user -> apartments as $apartment)
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h4 class="card-title">{{ $apartment -> address }}</h4>
              @foreach ($apartment -> messages as $message)
                <div class="d-flex flex-column">
                  <span class="m-2 btn btn-primary sender">{{$message -> sender}} </span>
                  <span class="d-none body_message"> {{$message -> text}}</span>
                </div>
              @endforeach
            </div>
          </div>


        @endforeach
        </div>

      </div>

    </div>


@endsection
