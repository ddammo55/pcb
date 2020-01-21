@extends('master')

@section('content')

	<h1>생성된 시리얼번호 {{ count($serial_name_arr) }}EA</h1>
	<form method="get" action="/product/create">
		<button class="ui button" type="submit">확인하고 돌아가기</button>	
	</form>

	@foreach ($serial_name_arr as $serial_name)
		{{$serial_name}}<br>
	@endforeach




@endsection