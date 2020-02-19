@extends('layouts.base')

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12">

            <div class="wrapper mt-5">
                <h4 class="text-center">Messaggi totali per questo appartamento : {{$apartment-> messages()->count()}}</h4>
                <script>
                var created_at = []; 
                </script>
               <div class="d-none">
                   @foreach ($apartment -> messages as $message)
                       {{$message -> created_at}}
                       <script>
                           created_at.push("{{$message -> created_at}}")
                       </script>
                   @endforeach
               </div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>


<script>
    //funzione per far restituire un elemento da un array 
var unique = function(origArr) {
        var newArr = [],
        origLen = origArr.length,
        found, x, y;
        for (x = 0; x < origLen; x++) {
        found = undefined;
        for (y = 0; y < newArr.length; y++) {
        if (origArr[x] === newArr[y]) {
        found = true;
        break;
        }
    }
    if (!found) {
    newArr.push(origArr[x]);
    }
}
    return newArr;
}
    console.log(unique(created_at))
    var ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels : unique(created_at),
            datasets: [{
                label: 'Messaggi',
                data: [{{$apartment-> messages()->count()}}],//il problema è qui , io gli chiedo il totale dei messaggi mentre dovrei chiedergli il count dei messaggi raggruppati per created_at
                backgroundColor: [
                    'rgba(99,180,255,0.21)'
                ],
                borderColor: [
                    
                    'rgba(99,180,255,1)'
                ],
                
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                labels: {
                    fontColor: 'black',
                    fontSize :15,
                    fontStyle : "bold"
                }
            },
            
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>


@endsection
