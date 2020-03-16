@extends('master')

@section('content')

<h1>{{$yearSelect}}년 생산수량 {{ number_format($year_count) }}EA</h1>

<div class="ui nine column grid">

    <div class="row">
      <div class="column">
        <form method="get" style="margin-top:20px;">
            <button style="padding:5px;" class="ui left labeled icon button" type="submit" value="완료" formaction="/yearSpc">
                <i class="left arrow icon"></i>
              <strong style="font-size:16px">{{ $yearSelect-1 }}년</strong>
            </button>
            <input type="hidden" name="year_select" value="{{  $yearSelect-1  }}">

        </form>
      </div>
      <div class="column">
        <form method="get" style="margin-top:20px;">
            <button style="padding:5px;" class="ui right labeled icon button" type="submit" value="완료" formaction="/yearSpc">
                <i class="right arrow icon"></i>
              <strong style="font-size:16px">{{ $yearSelect+1 }}년</strong>
            </button>
            <input type="hidden" name="year_select" value="{{  $yearSelect+1  }}">

        </form>
      </div>
    </div>

  </div>





{{--월별 생산 차트 --}}
<div class="ui message">
    <canvas id="productsChart" height="250"></canvas>
</div>

<?php
$join_arr1 = str_replace("|", ",", $join_arr1);
$join_arr2 = str_replace("|", ",", $join_arr2);
  //dd($join_arr1 );



?>


<script>
    var join_arr2 = "{{ $join_arr1  }}";
    var join_arr22 = "{{ $join_arr2 }}";

    console.log(join_arr2);

    console.log(join_arr22);



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

    console.log(ticks);

var ctx = document.getElementById('productsChart').getContext('2d');
var myChart = new Chart(ctx, {
type: 'line',
data: {
    labels: ticks,
    datasets: [{
        label: '{{$yearSelect}}년 총 생산수량 :{{ number_format($year_count) }}EA',
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

</script>

{{-- 차트 데이터값 표시 --}}
<script type="text/javascript">
    Chart.plugins.register({
    afterDatasetsDraw: function(chart) {
    var ctx = chart.ctx;
    chart.data.datasets.forEach(function(dataset, i) {
      var meta = chart.getDatasetMeta(i);
      if (!meta.hidden) {
      meta.data.forEach(function(element, index) {
        // Draw the text in black, with the specified font
        ctx.fillStyle = 'black';
        var fontSize = 15;
        var fontStyle = 'normal';
        var fontFamily = 'Helvetica Neue';
        ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
        // Just naively convert to string for now
        var dataString = dataset.data[index].toString();
        // Make sure alignment settings are correct
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        var padding = 5;
        var position = element.tooltipPosition();
        ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
      });
      }
    });
    }
  });

</script>


@endsection
