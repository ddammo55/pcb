@extends('master')

@section('content')



@foreach($views as $view)

{{-- 보드명이 널값이면 assy이름으로--}}
@if($view->board_name == null)
	<h2>
		{{ $view->division }}
		<i class="angle double right icon">&nbsp;{!! $view->assy_name !!} </i><br>
	</h2>
    <q>작성자: {{$view->wr_user}} | 작성일: {{ $view->created_at }}</q>
@else
	<h2>
		{{ $view->division }}
		<i class="angle double right icon">&nbsp;{!! $view->board_name !!} </i><br>
	</h2>
    <q>작성자: {{$view->wr_user}} | 작성일: {{ $view->created_at }}</q>
@endif

{{-- 페이지내용 불러오기--}}
<div class="ui divider"></div>
{!!$view->content!!}
@endforeach

<div class="ui divider"></div>

<h2>특이사항 및 토론</h2>



{{-- 코멘트 --}}
@if($view->tasks->count())
<div class="ui divider"></div>
@foreach($view->tasks as $task)
<div class="ui comments">

	<div class="comment">

		<a class="avatar">

			@foreach($users as $user)

			@if($user->name == $task->wr_user )
				<img src="{{ $user->profile_image }}">
			@endif
			@endforeach


		</a>
		<div class="content">
			<a class="author"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $task->wr_user }}</font></font></a>

			<div class="metadata">
				<span class="date"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
					{{ $task -> updated_at}}</font></font></span>
				</div>

				<div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
					{{ $task -> description}}
				</font></font>
			</div>

		</div>
	</div>
</div>
   @endforeach
{{-- 코멘트 --}}

@endif

<div class="ui divider"></div>

{{-- 댓글작성하기 구현 --}}
<form class="ui form" method="POST" action="/pbas/{{ $view->id }}/tasks">
	@csrf
  <div class="field">
    <label>새로운 특이사항 및 토론</label>
    <input type="text" name="description" placeholder="내용작성" required>
    <br>
    <br>
    <input class="ui primary button" type="submit" value="작성하기">
  </div>
</form>


<div class="ui divider"></div>














<br>
<a href="/pbas/{{ $view->id }}/edit">
<button class="ui secondary button"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
	제조영상 수정
</font></font></button></a>

<button class="ui pink button"  onclick="button_event();">제조영상 삭제</button>

<br>
<br>
<br>
<br>
<!-- 모달 -->
<div class="ui modal">
	<i class="close icon"></i>
	<div class="header">
			<i class="large red exclamation triangle icon"></i>
			제조영상
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
						<form method="POST" id="frm2" action="/pbas/{{ $view->id }}">
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



<script>
 function button_event(){
$('.ui.modal')
  .modal('show');
}
</script>


{{-- 이미지 클릭시 새창으로 원본사진보여주기 --}}
<script>
	var img = document.getElementsByTagName("img");
    for (var x = 0; x < img.length; x++) {
      img.item(x).onclick=function() {window.open(this.src)};
    }
</script>

@include('errors')

@endsection



