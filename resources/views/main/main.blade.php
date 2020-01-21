@extends('master')

@section('content')

<!-- <div class="txt-logo"><h3><span style="color:red;font-weight: bold;">품질</span>은 <span style="color:blue;font-weight: bold;">기본</span>이고, <span style="color:red;font-weight: bold;">납기</span>는 <span style="color:blue;font-weight: bold;">필수</span>이며, <span style="color:red;font-weight: bold;">원가</span>는 <span style="color:blue;font-weight: bold;">생존</span>이다!</h3></div> -->


<h1>통계적 공정 관리</h1>


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
              {{ number_format($pbaCount) }}
            </div>
          </div>
        </ul>
      </div>
    </div>

    <div class="column">
      <div class="ui message">
        <div class="header">
         ASS'Y 한도견본
        </div>
        <ul class="list">
          <div class="ui small statistic">
            <div class="value">
              {{ number_format($assyCount) }}
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
              {{ number_format($year_count) }}
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
            <a href="/monthProductList">{{ number_format($month_count) }} </a>
            </div>
          </div>
        </ul>
      </div>
    </div>

    <div class="column">
      <div class="ui message">
        <div class="header">
         {{ $nowMonth}}월 PPM
        </div>
        <ul class="list">
          <div class="ui small statistic">
            <div class="value">
            @foreach($month_ppm as $mon_ppm)
             {{ round($mon_ppm->ppm) }}
            @endforeach 
            </div>
          </div>
        </ul>
      </div>
    </div>

  </div>
</div>

<!-- 상단2 -->


<h3 class="ui horizontal divider header">
  <i class="bar chart icon"></i>
 {{ $nowYear }} AOI 전체 통계
</h3>

<br>


<div class="ui stackable two column grid">

  <div class="column">
    <div class="ui message" >
    <table class="ui celled table" style = "width : 100 %; height : 350px;">
          <thead>
            <tr><th>월</th>
              <th>생산수</th>
              <th>AOI<br>검사수</th>
              <th>AOI<br>불량수</th>
              <th>PPM</th>
              <th>미삽</th>
              <th>미납</th>
              <th>쇼트</th>
              <th>역삽</th>
              <th>오삽</th>
              <th>리드뜸</th>
              <th>리드부식</th>
              <th>모로섬</th>
              <th>뒤집힘</th>
              <th>틀어짐</th>
              <th>냉땜</th>
              <th>크랙</th>
            </tr></thead>
            <tbody>

           @foreach($spc_month as $spc_m)
                <tr>
                  <td class="ui right aligned">{{ $spc_m->pro_month }}</td>
                  <td class="ui right aligned" style="padding: 0px;">{{ number_format($spc_m->production) }}</td>
                  <td class="ui right aligned">{{ number_format($spc_m->aoi_part_num) }}</td>
                  <td class="ui right aligned">{{ number_format($spc_m->df) }}</td>
                  <td class="ui right aligned">{{ number_format($spc_m->ppm) }}</td>
                  <td class="ui right aligned">{{ $spc_m->d1 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d2 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d3 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d4 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d5 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d6 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d7 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d8 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d9 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d10 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d11 }}</td>
                  <td class="ui right aligned">{{ $spc_m->d12 }}</td>

                </tr>

           @endforeach

                      @foreach($spc_year as $spc_y)
                <tr style="border-width: 2px;">
                  <td class="ui right aligned">합계</td>
                  <td class="ui right aligned">{{ number_format($spc_y->production) }}</td>
                  <td class="ui right aligned">{{ number_format($spc_y->aoi_part_num) }}</td>
                  <td class="ui right aligned">{{ number_format($spc_y->df) }}</td>
                  <td class="ui right aligned">{{ number_format($spc_y->ppm) }}</td>
                  <td class="ui right aligned">{{ $spc_y->d1 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d2 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d3 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d4 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d5 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d6 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d7 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d8 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d9 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d10 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d11 }}</td>
                  <td class="ui right aligned">{{ $spc_y->d12 }}</td>

                </tr>

           @endforeach




             
            </tbody>
          </table>
        </div>
  </div>

  <div class="column">
    <div class="ui message" style="width:100%; height: 380px">

      <!--<h5>- 월별 생산수량 -</h5>-->
      <div id="chart1"></div>
    </div>
  </div>

</div>




<!-- <h4 class="ui horizontal divider header">
  <i class="tag icon"></i>
  작업 진행 상황
</h4> -->



<script>
$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
         
        //echo $join_arr2."<br>";

        //echo $join_arr22."<br>";

        var join_arr2 = "{{ $join_arr1  }}";
        var join_arr22 = "{{ $join_arr2 }}";

        var arr2 = join_arr2.split("|");
        var arr22 = join_arr22.split("|");

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
       
        var plot1 = $.jqplot('chart1', [s1], {
            // Provide a custom seriesColors array to override the default colors.
            seriesColors:['#73C774', '#00749F', '#73C774', '#C7754C', '#17BDB8'],
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          angle: 0
        }
    },
     rendererOptions: {
                
                // Set varyBarColor to tru to use the custom colors on the bars.
                varyBarColor: true
            },
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
                  
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks,
                    tickOptions: {
              
              
              fontSize: '10pt',
               angle:0
            

          }
     

                   
                },
                 yaxis:{
                min:0,
                max:3500,
                     },
            },
           
           


            highlighter: { show: false }
        });
     
        // $('#chart9').bind('jqplotDataClick', 
        //     function (ev, seriesIndex, pointIndex, data) {
        //         $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
        //     }
        // );
    });


</script>


<!--///////////////////////////////////-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.jqplot.1.0.8r1250/dist/jquery.jqplot.js"></script>
<script type="text/javascript" src="jquery.jqplot.1.0.8r1250/dist/plugins/jqplot.barRenderer.js"></script>
<script type="text/javascript" src="jquery.jqplot.1.0.8r1250/dist/plugins/jqplot.pieRenderer.js"></script>
<script type="text/javascript" src="jquery.jqplot.1.0.8r1250/dist/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="jquery.jqplot.1.0.8r1250/dist/plugins/jqplot.pointLabels.js"></script>
<link rel="stylesheet" type="text/css" href="jquery.jqplot.1.0.8r1250/dist/jquery.jqplot.css" />


@endsection