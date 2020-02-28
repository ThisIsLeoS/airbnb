@extends('layouts.base')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <div>

                    <img style="width:250px" src="{{asset("/images/Payment/Denied/denied.png")}}" alt="">
                </div>
                <h1 >Ci dispiace , non è possibile sponsorizzare questo appartamento in quanto risulta avere già una sponsorizzazione attiva !</h1>
                <h3>Sarai reindirizzato alla tua pagina personale tra </h3>
                <h3 id="time">3 secondi</h3>
            </div>
        </div>
    </div>

    
<script>
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



window.onload = function () {
  var threeSec = 60 * 0.05,
    display = document.querySelector('#time');
  startTimer(threeSec, display);
};
</script>
@endsection