@extends('master')

@section('content')


<form method="post" action="/profile/{{ $worktask->id }}">
    @csrf
    @method('PATCH')

<table class="ui celled table">
    <thead>
      <tr><th>공정명</th>
      <th>작성일</th>
      <th>공수</th>
    </tr></thead>
    <tbody>
      <tr>
        <td data-label="Name">

            <div class="field">
                <div class="ui selection dropdown">
                    <input class="input {{ $errors->has('process') ? 'is-danger' : '' }}" type="hidden" name="process"
                        value="{{ $worktask->process }}" placeholder="방법" required>
                    <i class="dropdown icon"></i>
                    <div class="default text" style="color: black">공정명을 선택하세요</div>
                    <div class="menu">
                        <div class="item">[A]SMD프로그램</div>
                        <div class="item">[B]SMT설비교체</div>
                        <div class="item">[C]SMT설비운영</div>
                        <div class="item">[D]AOI검사공정</div>
                        <div class="item">[E]DIP공정+웨이브솔더링</div>
                        <div class="item">[F]터치업+세척+컷팅</div>
                        <div class="item">[G]단품검사</div>
                        <div class="item">[H]코팅+실리콘</div>
                        <div class="item">[I]ASSY조립</div>
                        <div class="item">[J]무작업1(포장,준비)</div>
                        <div class="item">[K]설계변경,불량</div>
                    </div>
                </div>
            </div>
        </td>
        <td data-label="Age">{{$worktask->created_at->format('m-d')}}</td>
        <td data-label="Job"><input name='wt' type="number" value="{{ $worktask->wt }}"></td>
      </tr>
    </tbody>
  </table>

  <button class="fluid ui teal button">수정하기</button>

  <br>




</form>

<button class="fluid ui red button"  onclick="button_event();">공수 삭제</button>

{{-- 모달 --}}

<div class="ui modal">
	<i class="close icon"></i>
	<div class="header">
			<i class="large red exclamation triangle icon"></i>
			프로젝트명 삭제
	</div>
	<div class="image content">
		<div class="image">
			<h3>정말로 삭제하시겠습니까?</h3>
		</div>
		<div class="description">
			<h3>삭제하면 다시 복구할 수 없습니다.</h3>
		</div>
	</div>
	<div class="actions">
		<div style="border: 1px; float:right">
			<table>
				<tr>
					<td class="right floated content" >
						<div class="ui black deny button" >
							<font style="vertical-align: inherit;">취소</font>
						</div>
					</td>

					<td>
						<form method="POST" id="frm2" action="/profile/{{$worktask->id}}">
							@method('DELETE')
							@csrf
							<button class="ui pink deny button" type="submit" name="DELETE" value="DELETE">삭제</button>
						</form>
					</td>
				</tr>
			</table>
		</div>
		<p style="clear: both;">
	</div>
</div>

  <script type="text/javascript">
    function button_event(){
   $('.ui.modal')
     .modal('show')
   ;
   }
   </script>

@endsection
