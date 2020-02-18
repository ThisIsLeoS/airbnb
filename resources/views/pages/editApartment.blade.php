@extends('layouts.base')

@section('content')

  <form  action="{{ route('apartment.update', $apartment -> id ) }}" method="post">
    @csrf
    @method('POST')
    <label for="title">Descrizione</label>
    <input type="text" name="title" value="{{ $apartment -> title }}"><br>
    <label for="description">Descrizione</label>
    <input type="text" name="description" value="{{ $apartment -> description }}"><br>
    <label for="rooms">Stanze</label>
    <input type="number" name="rooms" value="{{ $apartment -> rooms }}"><br>
    <label for="beds">Letti</label>
    <input type="number" name="beds" value="{{ $apartment -> beds }}"><br>
    <label for="bathrooms">Bagni</label>
    <input type="number" name="bathrooms" value="{{ $apartment -> bathrooms }}"><br>
    <label for="square_feet">Metri quadri</label>
    <input type="number" name="square_feet" value="{{ $apartment -> square_feet }}"><br>
    <select  name="services[]" multiple>

      @foreach ($services as $service)
        <option value="{{ $service -> id }}" @if ($apartment -> services() -> find($service -> id))
          selected
        @endif>{{ $service -> type}}</option>

      @endforeach
    </select><br><br>
    <input type="submit" name="submit" value="MODIFICA">
  </form>

@endsection
