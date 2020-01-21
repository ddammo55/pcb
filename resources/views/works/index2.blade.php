@extends('master')

@section('content')
<h1>실시간 작업 리스트 & 공수입력
<br>

  <div class="ui segment" >


 

   

<div class="ui grid" style="padding: 10px; padding-top: 1px">
  <div class="three column row"  >
    <div class="column" style="background-color: #35BDB2; color: white">말레이시아 방송표시장치 ICPMC</div>
    <div class="column" style="background-color: #35BDB2; color: white">작성자 : 최원호</div>
    <div class="column" style="background-color: #35BDB2; color: white">작성일 : 2019-09-10</div>
  </div>
</div>

   <div class="ui form">

      {{-- 라인1 --}}
      <div class="fields" style="margin-top: -5px;">

        <div class="field">
          <label class="ui center aligned header">작업지시 번호</label>
          <input type="text" placeholder="First Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">프로젝트</label>
          <input type="text" placeholder="Middle Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">프로젝트코드</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">보드명</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">ASS'Y명</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">수량</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">편성</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">완료일</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">상태</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">공수합계</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">작업지시</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">완료</label>
          <input class="ui button" type="button" value="완료" placeholder="Last Name">
        </div>

      </div>


      {{-- 중간 --}}
      <div class="ui divider"></div>

      {{-- 라인2 --}}
      <div class="fields" style="margin-top: -10px; padding-top: -13px; margin-bottom: -1px;">

        <div class="field">
          <label class="ui center aligned header">SMT</label>
          <input type="text" placeholder="First Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">DIP</label>
          <input type="text" placeholder="Middle Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">AOI</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">납조+커팅</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">터치업+세척</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">코팅</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">ASS'Y</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">포장</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">준비작업</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">무작업</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field">
          <label class="ui center aligned header">기타</label>
          <input type="text" placeholder="Last Name">
        </div>

        <div class="field" style="width: 100px;">
          <label class="ui center aligned header">저장</label>
          <input class="ui button" type="button" value="저장" placeholder="Last Name">
        </div>





      </div>

    </div>

  </div>



@endsection
