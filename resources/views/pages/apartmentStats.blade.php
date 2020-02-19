@extends('layouts.base')

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12">

            <div class="wrapper mt-5">
                <h4 class="text-center">Messaggi totali per questo appartamento : {{$apartment-> messages()->count()}}</h4>
                {{$apartment-> title}}
                {{-- {{$apartment-> message -> sender}} --}}
                <script>

                    var created_at = []; 
                </script>
               
                @foreach ($apartment -> messages as $message)
                    {{$message -> sender}}
                    {{$message -> created_at}}
                    <script>
                        created_at.push("{{$message -> created_at}}")
                    </script>
                @endforeach
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>


<script>
    console.log(created_at)
     var ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels : created_at,
            datasets: [{
                label: 'Messaggi',
                data: [{{$apartment-> messages()->count()}}],
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
