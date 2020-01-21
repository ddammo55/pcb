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
          <label class="ui center aligned header">ASS'Y명</label>
          @if(auth()->user()->level >= 3)
          <input {{ $work->con == 1 ? 'disabled="disabled"' : '' }} style="border-color: gray; color: black;" type="text"  placeholder="ASS'Y명" name="assy" value="{{ $work->assy }}">
          @else
          <input disabled="disabled" style="border-color: gray; color: black;" type="text"  placeholder="ASS'Y명" name="assy" value="{{ $work->assy }}">
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
          <label class="ui center aligned header">ASS'Y</label>
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







<div class="ui segment" style="overflow-x: auto">
<table>
        <tr>

            <th><h5>작업지시번호</h5></th>
            <th><h5>프로젝트</h5></th>
            <th><h5>프로젝트코드</h5></th>
            <th><h5>보드명</h5></th>
            <th><h5>ASS'Y명</h5></th>
            <th><h5>수량</h5></th>
            <th><h5>편성</h5></th>
            <th><h5>생산완료일</h5></th>
            <th><h5>상태</h5></th>

        
            <th><h5>공수합계</h5></th>
              <th><h5>작업지시</h5></th>
            <th><h5>실적</h5></th>
            <th><h5>저장</h5></th>
{{--             </tr>
            
            <tr>
            <th><h5>SMT</h5></th>
            <th><h5>DIP</h5></th>
            <th><h5>AOI</h5></th>
            <th><h5>WAVE</h5></th>
            <th><h5>컷팅</h5></th>
            <th><h5>터치업+세척</h5></th>
            <th><h5>코팅</h5></th>
            <th><h5>ASS'Y</h5></th>
            <th><h5>포장</h5></th>
            <th><h5>준비작업</h5></th>
            <th><h5>무작업</h5></th>
            <th colspan="2"><h5>기타</h5></th>
          
        </tr> --}}
    </table>
   @foreach($works as $work)
   <form action="/works/{{$work->id}}" method="post">
    @csrf
    @method('PATCH')

    <table class="ui celled striped table">


    <tbody >

       

        <tr style="background-color: {{ $work->con == 1 ? '#B7CFE4' : '#B7CFE4' }} ">{{-- 여기에 백그라운드 --}}

          <td><div class="ui teal inverted segment" style="padding: 5px;">
  <p>{{ $work->work_no }}</p>
</div></h3></td>
          <td>{{ $work->project_name }}</td>
          <td>{{ $work->project_code }}</td>
          <td>{{ $work->board_name }}</td>
          <td>{{ $work->assy }}</td>

          <input type="hidden" name="work_no" value="{{ $work->work_no }}">
          <input type="hidden" name="project_name" value="{{ $work->project_name }}">
          <input type="hidden" name="board_name" value="{{ $work->project_code }}">
          <input type="hidden" name="assy" value="{{ $work->assy }}">

          @if(auth()->user()->level >= 3)
          <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">수량<input style="width:50px;" type="number" name="ea" size="5" value="{{ $work->ea }}"></td>
          @else
          <td>수량:[&nbsp;{{$work->ea}}&nbsp;]</td>
          @endif


          <td>{{ $work->set_set }}</td>

          @if(auth()->user()->level >= 3) {{-- 유저레벨이 3이면 --}}
            <td class="{{ $work->con == 1 ? 'disabled field' : '' }}"><input style="width:150px;" type="date" name="end_product_date" size="10" value="{{ $work->end_product_date }}"></td>  
          @else
            <td>{{ $work->end_product_date }}</td>
          @endif

          <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">
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
        </td >
        <td style="background-color: rgba(255, 255, 153)">{{ $work->total }}</td>

        @if(auth()->user()->level >= 3) {{-- 유저레벨이 3이면 --}}

          @if($work->wo != 0 || null)
          <td>작지<input style="width: 50px; background-color: skyblue" type="number" name="wo" value="{{ $work->wo }}"></td>
          @else
          <td>작지<input style="width: 50px" type="number" name="wo" value="{{ $work->wo }}"></td>
          @endif

        @else

          @if($work->wo != 0 || null)
          <td style="background-color: skyblue">작지{{ $work->wo }}</td>
          @else
          <td>작지{{ $work->wo }}</td>
          @endif

        @endif  
          
        @if(auth()->user()->level >= 3) {{-- 유저레벨이 3이면 --}}

          @if($work->per != 0 || null)
          <td>실적<input style="width: 50px; background-color: skyblue" type="number" name="per" value="{{ $work->per }}"></td>
          @else
          <td>실적<input style="width: 50px" type="number" name="per" value="{{ $work->per }}"></td>
          @endif

        @else
        
          @if($work->per != 0 || null)
          <td style="background-color: skyblue">실적{{ $work->per }}</td>
          @else
          <td>실적{{ $work->per }}</td>
          @endif

        @endif    

        <td class="ui center aligned">
          @if($work->con != 1) {{-- con값이 1이 아니면 즉 0이면 보여줄것 --}}
          <input type="submit" value="저장" formaction="/works/{{$work->id}}">
          @endif


          @if($work->con != 1) {{-- con값이 1이 아니면 즉 0이면 보여줄것 --}}
          @if(auth()->user()->level >= 3) {{-- 유저레벨이 3이면 --}}
          <input type="submit" value="완료" formaction="/workComplate/{{$work->id}}">
          <input type="hidden" name="con" value=1>
          @endif
          @endif



          @if($work->con != 0) {{-- con값이 1이 아니면 즉 0이면 보여줄것 --}}
          @if(auth()->user()->level >= 3) {{-- 유저레벨이 3이면 --}}
          <input type="submit" value="취소" formaction="/workComplate/{{$work->id}}">
          <input type="hidden" name="con" value=0>
          @endif
          @endif


        </td>

             </tr>

              <tr  style="background-color: #F6F6F6 ">
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">SMT<input style="width:50px;" type="number" name="smt"  value="{{ $work->smt }}"></td>
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">DIP<input style="width:50px;" type="number" name="dip"  value="{{ $work->dip }}"></td>
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">AOI<input style="width:50px;" type="number" name="aoi"  value="{{ $work->aoi }}"></td>
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">WAVE<input style="width:50px;" type="number" name="wave"  value="{{ $work->wave }}"></td>
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">커팅<input style="width:50px;" type="number" name="cutting"  value="{{ $work->cutting }}"></td>
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">터치업<input style="width:50px;" type="number" name="touchup"  value="{{ $work->touchup }}"></td>
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">코팅<input style="width:50px;" type="number" name="coting"  value="{{ $work->coting }}"></td>
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">ASSY<input style="width:50px;" type="number" name="ass"  value="{{ $work->ass }}"></td>
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">포장<input style="width:50px;" type="number" name="packing"  value="{{ $work->packing }}"></td>
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">준비<input style="width:50px;" type="number" name="ready"  value="{{ $work->ready }}"></td>
        <td class="{{ $work->con == 1 ? 'disabled field' : '' }}">무작업<input style="width:50px;" type="number" name="ect1"  value="{{ $work->ect1 }}"></td>
        <td  colspan="2" class="{{ $work->con == 1 ? 'disabled field' : '' }}">기타<input style="width:50px;" type="number" name="ect2"  value="{{ $work->ect2 }}"></td>


    </tr>

{{-- @if($work->memo) --}}
    <tr class="warning {{ $work->con == 1 ? 'disabled field' : '' }}">

        <td  colspan="26" style="border-bottom: 1px solid #544B4C; padding-bottom: 10px; ">
          메모&nbsp;<input style="width: 95%" type="text" name="memo"  value="{{ $work->memo }}">
        </td>
    </tr>
{{-- @endif --}}

</tbody>

</table>

</form>
    @endforeach

</div>

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
