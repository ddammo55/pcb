@extends('master')

@section('content')

<div class="ui segment">
	<div class="ui column very relaxed grid">
		<div class="wide column">
			<h1>보드명 수정</h1>
			<form class="ui form" id="frm" method="POST" action="/boardnames/{{ $boardname->id }}">
				@csrf
				@method('PATCH')
				<div class="field">
					<input class="input {{ $errors->has('boardname') ? 'is-danger' : '' }}" type="text" name="boardname" value="{{$boardname->boardname}}" placeholder="보드명" required>
				</div>	

				<div class="field">
					<input class="input {{ $errors->has('top_num') ? 'is-danger' : '' }}" type="number" name="top_num" value="{{$boardname->top_num}}" placeholder="TOP 부품수량" required>
				</div>	

				<div class="field">
					<input class="input {{ $errors->has('bot_num') ? 'is-danger' : '' }}" type="number" name="bot_num" value="{{$boardname->bot_num}}" placeholder="BOT 부품수량" required>
				</div>

				<div class="field">
					<input class="input {{ $errors->has('man_hour') ? 'is-danger' : '' }}" type="number" name="man_hour" value="{{$boardname->man_hour}}" placeholder="공수">
				</div>

				<div class="field">
					<div class="ui selection dropdown">
						<input class="input {{ $errors->has('method') ? 'is-danger' : '' }}" type="hidden" name="method" value="{{$boardname->method}}" placeholder="방법" required>
						<i class="dropdown icon"></i>
						<div class="default text" style="color: black">작업방법</div>
						<div class="menu">
							<div class="item">SMD</div>
							<div class="item">DIP</div>
							<div class="item">AS</div>
							<div class="item">외주</div>
							<div class="item">코팅</div>
							<div class="item">조립</div>
						</div>
					</div>
				</div>

				<div class="field">
              <div class="ui selection dropdown">
                <input class="input {{ $errors->has('top_method') ? 'is-danger' : '' }}" type="hidden" name="top_method" value="{{$boardname->top_method}}" placeholder="방법" required>
                <i class="dropdown icon"></i>
                <div class="default text" style="color: black">TOP소재</div>
                <div class="menu">
                  <div class="item">크림솔더</div>
                  <div class="item">본드</div>
                </div>
              </div>
            </div>

            <div class="field">
              <div class="ui selection dropdown">
                <input class="input {{ $errors->has('bot_method') ? 'is-danger' : '' }}" type="hidden" name="bot_method" value="{{$boardname->bot_method}}" placeholder="방법" required>
                <i class="dropdown icon"></i>
                <div class="default text" style="color: black">BOT소재</div>
                <div class="menu">
                  <div class="item">본드</div>
                  <div class="item">크림솔더</div>
                </div>
              </div>
    		</div>

            <div class="field">
                <input class="input {{ $errors->has('metal_mask_no') ? 'is-danger' : '' }}" type="number" name="metal_mask_no" value="{{$boardname->metal_mask_no}}" placeholder="메탈마스크 넘버" required>
            </div>

            <div class="field">
                <input class="input {{ $errors->has('dwg_no') ? 'is-danger' : '' }}" type="text" name="dwg_no" value="{{$boardname->dwg_no}}" placeholder="도면번호" required>
            </div>

            <div class="field">
                <input class="input {{ $errors->has('note') ? 'is-danger' : '' }}" type="text" name="note" value="{{$boardname->note}}" placeholder="메모">
            </div>

			</form>

			<br>
			<button class="ui secondary button" onclick="document.getElementById('frm').submit();"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
				보드명 수정
			</font></font></button>

			<button class="ui pink button"  onclick="button_event();">보드명 삭제</button>  

			@if($errors->any())
			<div class="ui pink inverted segment">

				<ul>	
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>	

			@endif
		</div>

	</div>
</div>




<!-- 모달 -->
<div class="ui modal">
	<i class="close icon"></i>
	<div class="header">
			<i class="large red exclamation triangle icon"></i>
			보드명 삭제
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
						<form method="POST" id="frm2" action="/boardnames/{{ $boardname->id }}">
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