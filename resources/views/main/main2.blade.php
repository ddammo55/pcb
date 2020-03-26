@extends('master')

@section('content')


<!-- <div class="txt-logo"><h3><span style="color:red;font-weight: bold;">품질</span>은 <span style="color:blue;font-weight: bold;">기본</span>이고, <span style="color:red;font-weight: bold;">납기</span>는 <span style="color:blue;font-weight: bold;">필수</span>이며, <span style="color:red;font-weight: bold;">원가</span>는 <span style="color:blue;font-weight: bold;">생존</span>이다!</h3></div> -->


<h1>통계적 공정 관리(SPC)</h1>


<!-- 상단1 -->
<div class="ui relaxed grid">
  <div class="three column row">

    <div class="column">
      <div class="ui message">
        <div class="header">
          총 PBA 데이터 수량(2016년~현재)
        </div>
        <ul class="list">
          <div class="ui small statistic">
            <div class="value">
              {{ number_format($productCount) }}
            </div>
          </div>
        </ul>
      </div>

    </div>

    <div class="column">
      <div class="ui message">
        <div class="header">
          PBA 한도견본
        </div>
        <ul class="list">
          <div class="ui small statistic">
            <div class="value">
              <a href="./pbas?"><b data-tooltip="바로가기" data-position="top right">{{ number_format($pbaCount) }}</b></a>
            </div>
          </div>
        </ul>
      </div>
    </div>

    <div class="column">
      <div class="ui message">
        <div class="header">
         ASSY 한도견본
        </div>
        <ul class="list">
          <div class="ui small statistic">
            <div class="value">
              <a href="./pbas?"><b data-tooltip="바로가기" data-position="top right">{{ number_format($assyCount) }}</b></a>
            </div>
          </div>
        </ul>
      </div>
    </div>

  </div>
</div>

<!-- 상단1 -->

<!-- 상단2 -->
<div class="ui relaxed grid">
  <div class="three column row">

    <div class="column">
      <div class="ui message">
        <div class="header">
         {{ $nowYear}}년 생산수량
        </div>
        <ul class="list">
          <div class="ui small statistic">
            <div class="value">
                <form  action="./monthProductList" method="GET">
                    <input type="hidden" name="start_date" value="{{ $nowYear }}-01-01">
                    <input type="hidden" name="end_date" value="{{ $nowYear }}-12-31">
                    <input type="hidden" name="date_choice" value="date_choice">
                    <b data-tooltip="바로가기" data-position="top right"><input class="inputnone" type="submit" value="{{ number_format($year_count) }}"></b>
                </form>
            </div>
          </div>
        </ul>
      </div>

    </div>

    <div class="column">
      <div class="ui message">
        <div class="header">
          {{ $nowMonth}}월 생산수량
        </div>
        <ul class="list">
          <div class="ui small statistic">
            <div class="value">
             <!--  클릭을 했을때 ShipmentsController@monthProduct페이지로 가게 -->
             <b data-tooltip="바로가기" data-position="top right"><a href="/monthProductList">{{ number_format($month_count) }} </a></b>
            </div>
          </div>
        </ul>
      </div>
    </div>

    <div class="column">
      <div class="ui message">
        <div class="header">
         {{ $nowMonth}}월 PPM <small>불량부품수/총부품수 * 1,000,000</small>
        </div>
        <ul class="list">
          <div class="ui small statistic">
            <div class="value">
             @if($month_ppm)
             @foreach($month_ppm as $mon_ppm)
             {{ sprintf('%0.2f', $mon_ppm->ppm )}}
             @endforeach
             @else
             0
             @endif
           </div>
          </div>
        </ul>
      </div>
    </div>

  </div>
</div>

<!-- 상단2 -->


<h3 class="ui horizontal divider header">



<form method="get" style="margin-top:20px;">
    <button style="padding:5px;" class="ui left labeled icon button" type="submit" value="완료" formaction="/yearSpc">
        <i class="left arrow icon"></i>
      <strong style="font-size:16px">{{ $nowYear-1 }}년 이전</strong>
    </button>
    <input type="hidden" name="year_select" value="{{  $nowYear-1  }}">

</form>


&nbsp;&nbsp;&nbsp;&nbsp;
 <i class="bar chart icon"></i>
 {{ $nowYear }} 생산 통계

</h3>

{{--월별 생산 차트 --}}
<div class="ui message">
  <canvas id="productsChart" height="250"></canvas>
</div>

{{--월별 공수 차트 --}}
<div class="ui message">
  <canvas id="worksChart" height="250"></canvas>
</div>


<div class="ui message" >
  <table class="ui celled table" style = "width : 100 %; height : 350px;">
    <thead>
      <tr><th class="ui center aligned">월</th>
        <th class="ui center aligned">생산수</th>
        <th class="ui center aligned">AOI<br>검사수</th>
        <th class="ui center aligned">AOI<br>불량수</th>
        <th class="ui center aligned">PPM</th>
        <th class="ui center aligned">미삽</th>
        <th class="ui center aligned">미납</th>
        <th class="ui center aligned">쇼트</th>
        <th class="ui center aligned">역삽</th>
        <th class="ui center aligned">오삽</th>
        <th class="ui center aligned">리드뜸</th>
        <th class="ui center aligned">리드불량</th>
        <th class="ui center aligned">모로섬</th>
        <th class="ui center aligned">뒤집힘</th>
        <th class="ui center aligned">틀어짐</th>
        <th class="ui center aligned">냉땜</th>
        <th class="ui center aligned">크랙</th>
      </tr></thead>
      <tbody>

       @foreach($spc_month as $spc_m)
       <tr>
        <td class="ui center aligned">{{ $spc_m->pro_month }}</td>
        <td class="ui right aligned" style="padding: 0px;">{{ number_format($spc_m->production) }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ number_format($spc_m->aoi_part_num) }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ number_format($spc_m->df) }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ sprintf('%0.2f',$spc_m->ppm) }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d1 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d2 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d3 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d4 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d5 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d6 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d7 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d8 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d9 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d10 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d11 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_m->d12 }}&nbsp;&nbsp;&nbsp;</td>

      </tr>

      @endforeach

      @foreach($spc_year as $spc_y)
      <tr style="border-width: 2px;">
        <td class="ui center aligned">합계</td>
        <td class="ui right aligned">{{ number_format($spc_y->production) }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ number_format($spc_y->aoi_part_num) }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ number_format($spc_y->df) }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ sprintf('%0.2f',$spc_y->ppm) }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d1 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d2 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d3 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d4 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d5 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d6 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d7 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d8 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d9 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d10 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d11 }}&nbsp;&nbsp;&nbsp;</td>
        <td class="ui right aligned">{{ $spc_y->d12 }}&nbsp;&nbsp;&nbsp;</td>

      </tr>

      @endforeach





    </tbody>
  </table>
</div>








<?php
$join_arr1 = str_replace("|", ",", $join_arr1);
$join_arr2 = str_replace("|", ",", $join_arr2);
  //dd($join_arr1 );
$join_arr_works = str_replace("|", ",", $join_arr_work);


?>
<!-- <h4 class="ui horizontal divider header">
  <i class="tag icon"></i>
  작업 진행 상황
</h4> -->
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


{{-- 공수차트 --}}
<script>
        //현재 월
        var month = "{{$nowMonth}}";

        //현재월 공수 합계
        var month_work_sum = "{{ $month_work_sum_total }}";

        // 현재공수 시간
        var month_work_dd = Math.round(month_work_sum/60);

        console.log(month_work_dd);

        var join_arr2 = "{{ $join_arr_works  }}";
        var join_arr22 = "{{ $join_arr2 }}";

        var arr2 = join_arr2.split(",");
        var arr22 = join_arr22.split(",");

        console.log(arr2);
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


var ctx = document.getElementById('worksChart').getContext('2d');
var myChart = new Chart(ctx, {
   type: 'bar',
    data: {
        labels: ["SMT프로그램","SMT준비교체","SMT운영","AOI검사","DIP솔더링","터치업+세척+컷팅","단품검사","코팅","ASSY조립","무작업(포,준,추)","무작업(설,불)"],
        datasets: [{
            label: month+'월 공수집계  '+ month_work_sum + ' 분' + '    ' + month_work_dd + '시간' ,
            data:  s1,
            backgroundColor: [
            'rgba(153, 102, 255, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            'rgb(153, 102, 255)',
            ],
            borderWidth: 2,
            borderColor:'rgba(255, 99, 132, 0.2)'

        }]
    },
    options: {
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
