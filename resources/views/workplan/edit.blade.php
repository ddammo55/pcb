@extends('master')

@section('content')

{{--  <div class="ui segment">
  <h2 class="ui left floated header">{{$workplan->project_name. ' ' .$workplan->title. ' '.$workplan->board_name. ' ' .$workplan->assy. ' ' .$workplan->ea.'EA'}} &nbsp;작업공수입력
   <strong style="color:#059DF5">Total: {{  number_format($worktasksSum) }}분 ({{ round($worktasksSum/60, 1)}}시간) </strong>
  </h2>

  <div class="ui clearing divider"></div>
  <p>작업지시번호: {{ $workplan->work_no}} | 작업일:{{ $workplan->start_product_date}} ~ {{ $workplan->end_product_date}} | 작성자:{{ $workplan->wr_user }} | 작성일:{{ $workplan->created_at}}</p>
  <p>메모 : {{ $workplan->memo}} </p>
</div>  --}}


  {{-- <div class="ui six column doubling stackable grid container"> --}}
    <h2 class="ui header">초중물 및 결점률 체크시트 {{ $workplan->work_no}}</h2>
    @include('workplan._sheet')
  {{-- </div> --}}




<h4 class="ui horizontal divider header">
    <i class="tag icon"></i>
    공수입력
  </h4>


{{-- 공수합계 --}}
<?php $sum=0 ?>
<table class="ui very padded table">
    <thead>
        <tr>
            {{-- <th>이미지</th> --}}
            <th>공정명</th>
            <th>작업자</th>
            <th>공수</th>
            <th>메모</th>
            <th>작성일</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($worktasks as $worktask)
      <tr>
        {{-- <td><img style="width:40px; height:40px;" class="ui avatar image" src="{{ asset(auth()->user()->image) }}"></td> --}}
        {{-- <td><img class="ui tiny image" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"></td> --}}
        <td>{{$worktask->process}}</td>
        <td>{{$worktask->wr_user}}</td>
        <td><b>{{$group = $worktask->wt}}</b>
        </td>
        <td>{{ $worktask->description }}</td>
        <td>{{$worktask->created_at}}</td>
        <?php $sum+= $worktask->wt ?>
    </tr>
    @endforeach


</tbody>
<tfoot class="ui inverted teal table">
    <tr>
    <th></th>
    <th>Total</th>
    <th>{{  number_format($sum) }}분 </th>
    <th>({{ round($sum/60, 1)}}시간)</th>
    <th></th>
  </tr></tfoot>
  </table>


{{--  공수리스트  --}}
{{-- <div class="ui segment">

<img style="width:60px; height:60px;" class="ui avatar image" src="{{ asset(auth()->user()->image) }}">
{{$worktask->process}}
{{$worktask->wr_user}}
{{$worktask->wt}}
{{ $worktask->description }}
{{$worktask->created_at}}

</div> --}}


{{-- STEP --}}
{{-- <div class="ui segment">

    <div class="ui ordered steps">
        <div class="completed step">
          <div class="content">
            <div class="title">Shipping</div>
            <div class="description">Choose your shipping options</div>
          </div>
        </div>
        <div class="completed step">
          <div class="content">
            <div class="title">Billing</div>
            <div class="description">Enter billing information</div>
          </div>
        </div>
        <div class="active step">
          <div class="content">
            <div class="title">Confirm Order</div>
            <div class="description">Verify order details</div>
          </div>
        </div>
      </div>

</div> --}}

{{-- 공수입력 --}}
{{-- 공수입력하기 구현 --}}
<div class="ui segment" style="background-color:#EAEAEA">
    <form class="ui form" method="POST" action="/worktask/{{ $workplan->id }}/tasks">
        @csrf
      <div class="field">
        <label>공정명 선택</label>
        <div class="field">
            <div class="ui selection dropdown">
                <input class="input {{ $errors->has('process') ? 'is-danger' : '' }}" type="hidden" name="process"
                    value="{{ old('process') }}" placeholder="방법" required>
                <i class="dropdown icon"></i>
                <div class="default text" style="color: black">공정명을 선택하세요</div>
                <div class="menu">
                    <div class="item">SMD프로그램</div>
                    <div class="item">SMT설비교체</div>
                    <div class="item">SMT설비운영</div>
                    <div class="item">AOI검사공정</div>
                    <div class="item">DIP공정+웨이브솔더링</div>
                    <div class="item">터치업+세척+컷팅</div>
                    <div class="item">단품검사</div>
                    <div class="item">코팅</div>
                    <div class="item">ASSY조립</div>
                    <div class="item">무작업1(포장,준비)</div>
                    <div class="item">무작업2(설변,불량)</div>
                </div>
            </div>
        </div>

        <label>공수 입력</label>
        <input type="number" name="wt" placeholder="공수" required>
        <br>
        <br>
        <label>메모 입력</label>
        <input type="text" name="description" placeholder="메모">
        <br>
        <br>
        <input class="ui primary button" type="submit" value="작성하기">
      </div>
    </form>
    </div>
    {{-- 댓글작성하기 구현 --}}
    <br>



@endsection
