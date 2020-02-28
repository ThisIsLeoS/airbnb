@extends('layouts.base')

@section('content')

<style>
    .card-img-top {
    width: 100%;
    height: 300px;
    }

    .card{
        border:none !important;
        background-color:rgba(0,0,0,0) !important;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-5">
            <div class="card" style="width: 25rem;">
                @if ( $message == "Il pagamento è andato a buon fine")
                    <img class="card-img-top" src="{{asset("images/Payment/Success/success.png")}}" alt="Card image cap">  
                @else
                
                    <img class="card-img-top" src="{{asset("images/Payment/Denied/denied.png")}}" alt="Card image cap">
                @endif
                
                <div class="card-body">
                    <p class="card-text">
                        <div id="myProgress">
                            <div id="myBar" class="text-center">
                                <p></p>
                            </div>
                        </div>
                    </p>
                    <h5 class="card-title text-center d-none"><strong>{{ $message }}</strong></h5>
                    <div  class="card-title text-center countdown d-none">
                        <h5>Sarai reindirizzato alla pagina dei tuoi appartamenti tra  <span id="time">3 secondi</span></h5>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
    move();
})

@if($message !== "Il pagamento è andato a buon fine"){

    $("#myBar").css("background-color","red");
}
@endif

 var threeSec = 60 * 0.05,
display = document.querySelector('#time');
   
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
            $(".countdown").removeClass("d-none");
            startTimer(threeSec, display);
        }
      } else {
        width++;
        elem.style.width = width + "%";
      }
      
    }
  }
}

    function startTimer(duration, display) {
  var timer = duration, seconds;
  setInterval(function () {
    seconds = parseInt(timer % 4);

    /* seconds = seconds < 10 ? "3" + seconds : seconds; */

    display.textContent = seconds + " secondi";

    if (--timer < 0) {
      timer = duration;
    }
  }, 1000);
}




 
  

</script>
    
@endsection
