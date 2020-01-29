@extends('master')

@section('content')
<style>
  .month_button{
    float: left;
  }
</style>

<div class="ui grid">

  <div class="ten wide column">
    @for($j=1;$j<=12; $j++)

    <form action="/monthProductList" method="GET">
      <button class="ui secondary button month_button">{{$j}}월 </button>
      <input type="hidden" name="month" value="{{ $j }}">
    </form>
    @endfor
  </div>

    <div class="six wide column">

        <form class="ui form" action="/monthProductList" method="GET">
        @csrf

                <div class="ui input"><input type="date" name="start_date" value="{{$start_date}}"></div>

                <div class="ui input"><input type="date" name="end_date" value="{{$end_date}}"></div>



                    <input type="hidden" name="date_choice" value="date_choice">
                    {{--  <input type="submit" type="button" value="검색">  --}}
                    <button class="ui teal button" type="submit" value="date_choice">검색</button>



    </form>
    </div>




</div>









<div class="ui divider">

</div>

@foreach($month_products_sum as $month_sum)



@if(isset($choice))
    <h1>{{ $choice }}월 생산수량 / {{ $month_count }} 종 / {{ $month_sum->products_sum}} 장</h1>
@elseif(isset($date_choice))
        <h1>{{$start_date}}~{{$end_date}} 생산수량 / {{ $month_count }} 종 / {{ $month_sum->products_sum}} 장</h1>
@else
		<h1>{{ $nowMonth }}월 생산수량 / {{ $month_count }} 종 / {{ $month_sum->products_sum}}장</h1>
@endif

@endforeach
		<?php
		$i=1;
		?>
    <div class="ui two column grid">
            <div class="row">

                <div class="column">
                <table class="ui celled table">
                  <thead>
                  	<th>NO</th>
                    <th>보드명</th>
                    <th>작업수량</th>
                    <th>생산일</th>
                  </tr></thead>

                  <tbody>
                  	@foreach($month_products as $month_product )
                    <tr>
                      <td data-label="Name">{{ $i++ }}</td>
                      <td data-label="Name">
                        <form action="/monthProductListSel" method="GET">
                          <input type="hidden" name="board_name" value="{{ $month_product->board_name }}" >
                          <input type="hidden" name="product_date" value="{{ $month_product->product_date }}" >
                         <button style=" background:none;border:none; margin:0px;cursor: pointer;">{{ $month_product->board_name }}</button>
                        </form>

                      </td>
                      <td data-label="Name">{{ $month_product->sum }}</td>
                      <td data-label="Name">{{ $month_product->product_date }}</td>

                    </tr>
                    @endforeach
                  </tbody>

                </table>
                </div>

            </div>
    </div>

@endsection('content')
