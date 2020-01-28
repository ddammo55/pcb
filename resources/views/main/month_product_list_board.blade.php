@extends('master')

@section('content')
<h1>{{ $board_name }} / {{ $results_count }} 장</h1>
		<?php
		$i=1;
		?>
    <div class="ui one column grid">
            <div class="row">

                <div class="column">
                <table class="ui celled table">
                  <thead>
                  	<th>NO</th>
                  	<th>시리얼번호</th>
                    <th>보드명</th>
                    <th>생산일</th>
                    <th>출하일</th>
                    <th>출하내역</th>
                    <th>불량</th>
                    <th>불량내용</th>
                    <th>타입</th>
                    <th>메모</th>
                    <th>인수자</th>
                    <th>인계자</th>
                  </tr></thead>

                  <tbody>
                  	@foreach($results as $result )
                    <tr>
                      <td data-label="Name">{{ $i++ }}</td>

                      <td data-label="Name">
                        <form action="/serialNameSearch" method="GET">
                          <input type="hidden" name="serial_name" value="{{ $result->serial_name }}">
                          <button button style=" background:none;border:none; margin:0px;cursor: pointer;">{{ $result->serial_name }}</button>
                        </form>
                      </td>

                      <td data-label="Name">
                        <form action="/pbas/" method="GET">
                          <input type="hidden" name="board_name" value="{{ $result->board_name }}" >
                          <button style=" background:none;border:none; margin:0px;cursor: pointer;">{{ $result->board_name }}</button>
                        </form>
                      </td>
                      
                      <td data-label="Name">{{ $result->product_date }}</td>
                      <td data-label="Name">{{ $result->shipment }}</td>
                      <td data-label="Name">{{ $result->shipment_daily }}</td>
                      <td data-label="Name">{{ $result->faulty }}</td>
                      <td data-label="Name">{{ $result->remarks }}</td>
                      <td data-label="Name">{{ $result->type }}</td>
                      <td data-label="Name">{{ $result->memo }}</td>
                      <td data-label="Name">{{ $result->receiver }}</td>
                      <td data-label="Name">{{ $result->ship_user }}</td>

                    </tr>
                    @endforeach
                  </tbody>

                </table>
                </div>

            </div>
    </div>
		
@endsection('content')