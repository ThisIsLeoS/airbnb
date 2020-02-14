<div>
  <input  type="text" name="" value="">
  <button  name="button">cerca</button>
  @foreach ($apartmentsToShow as $apartment)
      {{$apartment->id}}
      {{$apartment->description}}
  @endforeach
</div>
