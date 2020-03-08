@extends('master')

@section('content')

<h1>실시간 작업 리스트 & 공수입력
@if(Auth::check())
  @if(auth()->user()->level >= 3)
    <a class="ui primary button" href="/works/create">추가하기</a>
  @endif
@endif
</h1>

@foreach($works as $work)

<div class="ui segment" >

<div class="ui grid" style="padding: 15px; padding-top: 1px">
  <div class="three column row">
    @if($work->con != 1) {{-- con값이 1이 아니면 즉 0이면 보여줄것 --}}
      <div class="column" style="background-color: #35BDB2; color: white; padding: 5px;">{{ $work->project_name }} {{ $work->project_code }} {{ $work->board_name }} {{ $work->assy }} {{ $work->ea }}ea {{ $work->title}} </div>
      <div class="column" style="background-color: #35BDB2; color: white; padding: 5px;">작성자 : 최원호</div>
      <div class="column" style="background-color: #35BDB2; color: white; padding: 5px;">작성일 : {{ $work->created_at }}</div>
    @else
      <div class="column" style="background-color: #C1BDC3; color: white; padding: 5px;">말레이시아 방송표시장치 ICPMC</div>
      <div class="column" style="background-color: #C1BDC3; color: white; padding: 5px;">작성자 : 최원호</div>
      <div class="column" style="background-color: #C1BDC3; color: white; padding: 5px;">작성일 : {{ $work->created_at }}</div>
    @endif
  </div>
</div>




   <div class="ui form">

    <form action="/works/{{$work->id}}" method="post">
      @csrf
      @method('PATCH')

      {{-- 히든 --}}
      <input type="hidden" name="work_no" value="{{ $work->work_no }}">
      <input type="hidden" name="project_name" value="{{ $work->project_name }}">
      <input type="hidden" name="board_name" value="{{ $work->board_name }}">
      <input type="hidden" name="ea" value="{{ $work->ea }}">
      <input type="hidden" name="end_product_date" value="{{  $work->end_product_date }}">
      <input type="hidden" name="assy" value="{{ $work->assy }}">


      {{-- 라인1 --}}
      <div class="fields" style="margin-top: -5px;">

        <div class="field">
          <label class="ui center aligned header">작업지시 번호</label>
          <input disabled="disabled" style="border-color: gray; color: blue; font-weight: bold;" type="text" value="{{ $work->work_no }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">프로젝트</label>
          <input disabled="disabled" style="border-color: gray; color: black;" type="text" value="{{ $work->project_name }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">프로젝트코드</label>
          <input disabled="disabled" style="border-color: gray; color: black;" type="text" placeholder="프로젝트코드" value="{{ $work->project_code }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">보드명</label>
          @if(auth()->user()->level >= 3)
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }}  style="border-color: gray; color: black;" type="text" placeholder="보드명" name="board_name" value="{{ $work->board_name }}">
          @else
          <input disabled="disabled" style="border-color: gray; color: black;" type="text" placeholder="보드명" name="board_name" value="{{ $work->board_name }}">
          @endif
        </div>

        <div class="field">
          <label class="ui center aligned header">ASSY명</label>
          @if(auth()->user()->level >= 3)
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} style="border-color: gray; color: black;" type="text"  placeholder="ASSY명" name="assy" value="{{ $work->assy }}">
          @else
          <input disabled="disabled" style="border-color: gray; color: black;" type="text"  placeholder="ASSY명" name="assy" value="{{ $work->assy }}">
          @endif
        </div>


        <div class="field">
          <label class="ui center aligned header">수량</label>
          @if(auth()->user()->level >= 3)
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="ea" placeholder="수량" value="{{ $work->ea }}">
          @else
          <input disabled="disabled" style="border-color: gray; color: black;" style="border-color: gray; color: black"  name="ea" type="number" placeholder="수량" value="{{ $work->ea }}">
          {{-- <input type="hidden" name="ea"  placeholder="수량" value="{{ $work->ea }}"> --}}
          @endif
        </div>

        <div class="field">
          <label class="ui center aligned header">편성</label>
          <input disabled="disabled" name="end_product_date" style="border-color: gray; color: black;" type="text" placeholder="편성">
        </div>

        <div class="field">
          <label class="ui center aligned header">완료일</label>
          @if(auth()->user()->level >= 3)
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} style="border-color: gray; color: black;"  type="date" name="end_product_date" value="{{ $work->end_product_date }}" placeholder="완료일">
          @else
          <input disabled="disabled" style="border-color: gray; color: black;"  type="date" name="end_product_date" value="{{ $work->end_product_date }}" placeholder="완료일">

        @endif
        </div>

        <div class="field" style="width: 150px; margin-top: -3px;">
          <label>상태</label>
          <select name="status" value="{{ $work->status }}">
              @if($work->status == "진행")
                <option selected="selected">진행</option>
                <option>자재</option>
                <option>품질</option>
                <option>완료</option>
              @elseif($work->status == "자재")
                <option>진행</option>
                <option selected="selected">자재</option>
                <option>품질</option>
                <option>완료</option>
              @elseif($work->status == "품질")
                <option>진행</option>
                <option >자재</option>
                <option selected="selected">품질</option>
                <option>완료</option>
               @elseif($work->status == "완료")
                <option>진행</option>
                <option >자재</option>
                <option>품질</option>
                <option  selected="selected">완료</option>

              @endif
            </select>
        </div>

        <div class="field">
          <label class="ui center aligned header">공수합계</label>
          <input disabled="disabled" style="border-color: gray; color: red;" type="text" placeholder="공수합계" value="{{ $work->total }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">작업지시</label>

          @if(auth()->user()->level >= 3)
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} name="wo" style="border-color: black; color: black;" type="text" placeholder="작업지시" value="{{ $work->wo }}">
          @else
          <input disabled="disabled" name="wo" style="border-color: black; color: black;" type="text" placeholder="작업지시" value="{{ $work->wo }}">
          @endif

        </div>

        <div class="field">
          @if($work->con != 1) {{-- con값이 1이 아니면 즉 0이면 보여줄것 --}}
          @if(auth()->user()->level >= 3) {{-- 유저레벨이 3이면 --}}
          <label class="ui center aligned header">완료</label>
          <input class="ui button" type="submit" value="완료" formaction="/workComplate/{{$work->id}}">
          <input type="hidden" name="con" value=1>
          @endif
          @endif



          @if($work->con != 0) {{-- con값이 1이 아니면 즉 0이면 보여줄것 --}}
          @if(auth()->user()->level >= 3) {{-- 유저레벨이 3이면 --}}
          <input class="ui button" type="submit" value="취소" formaction="/workComplate/{{$work->id}}">
          <input type="hidden" name="con" value=0>
          @endif
          @endif
        </div>

      </div>




      {{-- 중간 --}}
      <div class="ui divider"></div>

      {{-- 라인2 --}}
      <div class="fields" style="margin-top: -10px; padding-top: -13px; margin-bottom: -1px;">

        <div class="field">
          <label class="ui center aligned header">SMT</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="smt" value="{{ $work->smt }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">DIP</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="dip" value="{{ $work->dip }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">AOI</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="aoi" value="{{ $work->aoi }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">납조+커팅</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="wave" value="{{ $work->wave }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">터치업+세척</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="touchup" value="{{ $work->touchup }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">코팅</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="coting" value="{{ $work->coting }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">ASSY</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="ass" value="{{ $work->ass }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">포장</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="packing" value="{{ $work->packing }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">준비작업</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="ready" value="{{ $work->ready }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">무작업</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="ect1" value="{{ $work->ect1 }}">
        </div>

        <div class="field">
          <label class="ui center aligned header">기타</label>
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} type="number" name="ect2" value="{{ $work->ect2 }}">
        </div>

        <div class="field" style="width: 100px;">
          <label class="ui center aligned header">저장</label>
           <input class="ui button" type="submit" value="저장" formaction="/works/{{$work->id}}">
        </div>

      </div>

    </form>
    </div>

  </div>



   @endforeach


{{-- 새거 --}}









{{-- 페이지네이션--}}
@if($works->count())
{{ $works->links() }}
@endif

<style>
  table {
    width: 100%;
    border-top: 1px solid gray;
    border-collapse: collapse;
  }
  th {
    border-bottom: 1px solid #444444;
    padding: 10px;
  }

input[type="text"][disabled] {
   color: red;
}
</style>






@endsection
