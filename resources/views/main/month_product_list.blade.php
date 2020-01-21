@extends('master')

@section('content')
<style>
  .month_button{
    float: left;
  }
</style>

<div >
@for($j=1;$j<=12; $j++)

<form action="/monthProductList" method="GET">
      <button class="ui secondary button month_button">{{$j}}월 </button>
      <input type="hidden" name="month" value="{{ $j }}">
</form>
@endfor

</div>
<br/>
<br/>
<div class="ui divider"></div>

@foreach($month_products_sum as $month_sum)



@if(isset($choice))
    <h1>{{ $choice }}월 생산수량 / {{ $month_count }} 종 / {{ $month_sum->products_sum}} 장</h1>
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