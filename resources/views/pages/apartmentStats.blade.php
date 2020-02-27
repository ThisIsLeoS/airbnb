@extends('layouts.base')


@section("content")
<style>
  main{
    height:80vh;
    background:url("/images/Statistic/statistic.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-attachment: fixed;
  }
</style>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-6">
            <div class="wrapper mt-5">
                <h4 class="text-center">Messaggi totali per questo appartamento : {{$apartment-> messages()->count()}}</h4>
                <script>
                var created_atMex = [];
                var messageCount = [];
                </script>
                <div class="d-none">
                    @foreach ($messagesCount as $messageCount)
                        {{$messageCount -> count}}
                        <script>
                            messageCount.push("{{$messageCount -> count}}")
                        </script>
                    @endforeach
                    @foreach ($apartment -> messages as $message)
                        {{$message -> created_at}}
                        <script>
                            created_atMex.push("{{$message -> created_at ->format('d-m-Y')}}")
                        </script>
                    @endforeach
                </div>
                <canvas id="myChartMex"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="wrapper mt-5">
            <h4 class="text-center">Visualizzazioni totali per questo appartamento : {{$apartment-> views()->count()}}</h4>
            <script>
                var created_atViews = [];
                var viewsCount = [];
            </script>
            <div class="d-none">
                @foreach ($viewsCount as $viewCount)
                    {{$viewCount -> count}}
                    <script>
                        viewsCount.push("{{$viewCount -> count}}")
                    </script>
                @endforeach
                @foreach ($apartment -> views as $view)
                    {{$view -> created_at}}
                    <script>
                        created_atViews.push("{{$view -> created_at ->format('d-m-Y')}}")
                    </script>
                @endforeach
                </div>
            </div>
            <canvas id="myChartViews"></canvas>
        </div>
    </div>
</div>

{{-- Le views di questo appartamento sono: {{ $viewsCount }} --}}

<script>
    //funzione per far restituire un array con elementi NON ripetuti
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

    printGraphs("myChartMex",unique(created_atMex),"Messaggi",messageCount,'rgba(99,180,255,0.21)','rgba(99,180,255,1)');
    printGraphs("myChartViews",unique(created_atViews),"Visite",viewsCount,'rgba(255,219,156,0.21)','rgba(235,190,141,1)');


    function printGraphs(where,labels,label,data ,bgColor,borderColor){
    var ctx = document.getElementById(where).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels : labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: [
                    bgColor
                ],
                borderColor: [
                    borderColor
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
  }
</script>


@endsection
