@extends('master')

@section('content')

<h1>{{$yearSelect}}년 생산수량</h1>

{{--월별 생산 차트 --}}
<div class="ui message">
    <canvas id="productsChart" height="250"></canvas>
  </div>


  <script>
    var join_arr2 = "{{ $join_arr1  }}";
    var join_arr22 = "{{ $join_arr2 }}";



    var arr2 = join_arr2.split(",");
    var arr22 = join_arr22.split(",");

    //console_log(arr2);
    var s1 = new Array();
    var ticks = new Array();


    // s1 : 그래프 y축.
    // ticks : 그래프 x축

    for(var i=0; i<arr2.length;i++){
       s1.push(arr2[i]);
    }

    for(var i=0; i<arr22.length;i++){
       ticks.push(arr22[i]+'월');
    }


var ctx = document.getElementById('productsChart').getContext('2d');
var myChart = new Chart(ctx, {
type: 'line',
data: {
    labels: ticks,
    datasets: [{
        label: '월 별 생산수량',
        data: s1,
        backgroundColor: [
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(54, 162, 235, 0.2)',
        ],
        borderColor: [
           'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(54, 162, 235, 1)',
        ],
        borderWidth: 1
    }]
},
options: {
  elements: {
        line: {
            tension: 0 // disables bezier curves
        }
    },
  maintainAspectRatio: false,
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
