@extends('layouts.base')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="notAllowed">
            <p>Ops...Sembra che tu stia tentando di accedere ad una pagina senza autorizzazione !!!</p>
                <p>Sarai reindirizzato alla Home tra </p>
                <span id="time">3 secondi</span>
            </div>
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

