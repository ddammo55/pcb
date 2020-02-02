@extends('master')

@section('content')

<h1>생성된 시리얼번호 {{ count($serial_name_arr) }}EA</h1>

<div class="ui grid">

    <div class="two wide column">
        <form method="get" action="/product/create">
            <button class="ui button" type="submit">확인하고 돌아가기</button>
        </form>
    </div>

    <div class="two wide column">
        <form method="POST" action="./shipment2">
            @csrf
            <input type="hidden" name="serial_name_arr" value="{{ json_encode($serial_name_arr)}}">
            <button class="ui button" type="submit">출하내역 바로하기</button>
        </form>

    </div>
</div>

@foreach ($serial_name_arr as $serial_name)
{{$serial_name}}<br>
@endforeach

@endsection
