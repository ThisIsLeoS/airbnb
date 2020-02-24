@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-5">
            <div class="card" style="width: 25rem;">
                <img class="card-img-top" src="{{asset("images/Payment/Success/success.png")}}" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">
                        <div id="myProgress">
                            <div id="myBar" class="text-center">
                                <p></p>
                            </div>
                        </div>
                    </p>
                    <h5 class="card-title text-center d-none">{{ $message }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
    move();
})
   
    var i = 0;
function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
        $("#myBar p").text(width + "%")
      if (width >= 100) {
        clearInterval(id);
        i = 0;
        if(width == 100){
            $(".card-title").removeClass("d-none");
        }
      } else {
        width++;
        elem.style.width = width + "%";
      }
      
    }
  }
}
</script>
    
@endsection
