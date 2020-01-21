@extends('master')

@section('content')

@foreach($serialNameSearchs as $serialNameSearch)

<h1>{{ $serialNameSearch->serial_name }} 검색결과

@if(Auth::check())
@if(auth()->user()->level >= 2)

<a class="ui primary button" href="/product/{{ $serialNameSearch->id }}/edit">수정하기</a>

@endif
@endif


</h1>

<div class="ui stackable two column grid">

<div class="column">

<table class="ui celled table">
	<thead>
		<tr>
			<th>정보목록</th>
			<th>내용</th>

		</tr>
	</thead>
		<tbody>

			<tr >
				<td style="padding: 8px;">시리얼번호</td>
				<td style="padding: 8px;">{{ $serialNameSearch->serial_name }}</td>
			</tr>

			<tr>
				<td style="padding: 8px;">보드명</td>
				<td style="padding: 8px;">{{ $serialNameSearch->board_name }}</td>
			</tr>

			<tr>
				<td style="padding: 8px;">생산일</td>
				<td style="padding: 8px;">{{ $serialNameSearch->product_date }}</td>
			</tr>

			<tr>
				<td style="padding: 8px;">출하내역</td>
				<td style="padding: 8px;">{{ $serialNameSearch->shipment_daily }}</td>
			</tr>

			<tr>
				<td style="padding: 8px;">출하날짜</td>
				<td style="padding: 8px;">{{ $serialNameSearch->shipment }}</td>
			</tr>

			<tr>
				<td style="padding: 8px;">인수자</td>
				<td style="padding: 8px;">{{ $serialNameSearch->receiver }}</td>
			</tr>

			<tr>
				<td style="padding: 8px;">인계자</td>
				<td style="padding: 8px;">{{ $serialNameSearch->ship_user }}</td>
			</tr>

			<tr>
				<td style="padding: 8px;">코팅두께</td>
				<td style="padding: 8px;">{{ $serialNameSearch->coting_t }}</td>
			</tr>

			<tr>
				<td style="padding: 8px;">타입</td>
				<td style="padding: 8px;">{{ $serialNameSearch->type }}</td>
			</tr>

			<tr>
				<td style="padding: 8px;">불량</td>
				<td style="padding: 8px;">{{ $serialNameSearch->faulty }}</td>
			</tr>

			<tr>
				<td style="padding: 8px;">특이사항</td>
				<td style="padding: 8px;">{{ $serialNameSearch->note }}</td>
			</tr>
			
		</tbody>
	</table>

</div>


</div>





	@endforeach

	@endsection