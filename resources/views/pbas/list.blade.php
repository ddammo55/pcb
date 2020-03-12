@extends('master')

@section('content')




@foreach($pbas_cas as $pbas_ca)
	<div class="ui label" style="margin-bottom: 0.5em"><a href="/pbas/{{ $pbas_ca[0]->id }}">{{ $pbas_ca[0]->project_name }}</a></div>

@endforeach



<div class="ui divider"></div>

<div class="ui five column stackable padded grid">

	@foreach($pbas as $pba)
  <div><div class="ui message" style="padding: 0.2em 1em; margin-bottom: 15px;">

		<div class="ui very relaxed items"  style="margin: 0.5em 0em;">

			<div class="item" style="margin: 0.5em 0em;">


				<div class="image">
					@if($pba->division == "PBA")
					<a href='/pbas/{{$pba->id}}/view'>
					<a class="ui green ribbon label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
					@else

					<a class="ui blue ribbon label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
					@endif
						{{ $pba->division }}
					 </font></font></a>


					<?php
					$contents = $pba->content;

					$searchName = "img";

					//img태그가 있으면 아래꺼 실행 즉 이미지가 있으면 아래꺼 실행
					if(strpos($contents, $searchName) !== false) {

					preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", stripslashes($contents), $matches);

					//이미지의 주소값을 /구분으로 배열에 담는다.
					 $var_arr = explode('/', $matches[1][0]);
					 //echo $var_arr[3];
					 //dd($var_arr[4]); //[3]=ASSY [4]신림선TCMS
					//http://tiny.test/photos/shares/Desert.jpg
					//http://tiny.test/photos/shares/thumbs/Desert.jpg
					//http://pcb.test/photos/shares/ENCO-DECO(%EA%B5%AC)/7e1ab1fac974fa1d69199238bef15de1.jpg
					?>
					<!-- <a href='/pbas/{{$pba->id}}/view'> -->
					<?php
					//이미지의 주소값을 담는다 [0][0]은 이미지를 뽑아온다.
					// $url = str_replace('/shares/'.$var_arr[3].'/', '/shares/'.$var_arr[3].'/thumbs/', $matches[1][0]);
					 $url = str_replace('/shares/'.$var_arr[4].'/', '/shares/'.$var_arr[3].'/thumbs/', $matches[1][0]);
					//echo $url = str_replace('/shares/', '/shares/[폴더명정규표현식]/thumbs/', $matches[0][0]);
					//print_r($matches[0][0]);
					//var_dump($matches[0][0]);
					//주소값의 thumbs 디렉터리 추가
					?>
					<a href="/pbas/{{$pba->id}}/view">
						<!-- {{ $url }} -->
						<img  class="image" src="{{ $url }}" width="100%" height="120px">
					</a>
				<!-- </a> -->
				<?php
				}else{
					?>
					<a href="/pbas/{{$pba->id}}/view">
						<?php
						echo "<img src='http://pcb.test/photos/shares/thumbs/noimage.JPG' width='175px' height='125px'>";
						?>
					</a>
					<?php
				}
				?>

					@if($pba->division == 'PBA')
					<div class="ui divider"></div>
					<p><a href="/pbas/{{$pba->id}}/view"><b>{{ $pba->board_name }}</b></a></p>
					@else
					<div class="ui divider"></div>
					<p><p><a href="/pbas/{{$pba->id}}/view"><b>{{ $pba->assy_name }}</b></a></p>
					@endif


					<p style="font-size: 12px;">등록일 : {{ substr($pba->updated_at,0,-8) }}</p>
					<p style="font-size: 12px;">등록자 : {{ $pba->wr_user }}</p>
				</div>


			</div>
		</div>
	</div></div>
  @endforeach
</div>

<div class="ui divider"></div>

<div class="ui menu">

	<div class="item">
		<form method="get" action="/pbas">
			<button class="ui black button" type="submit">
				{{ $pbas_counts }} &nbsp;종류
			</button>
		</form>
	</div>

  <div class="item">
   <form method="get" action="/pbas">
  		<button class="ui black button" type="submit">
  			전체 목록보기
  		</button>
  	</form>
  </div>

 <div class="item">
  <button class="ui teal button"  onclick="button_event();">작성하기</button>
</div>
<!--   <div class="item">
   <form method="get" action="/pbas/create">
  		<button class="ui teal button" type="submit">
  			글 작성하기
  		</button>
  	</form>
  </div> -->

  <div class="item">
   <form method="get" action="/pbas/" id="frm2">
  		@csrf
  		<div class="ui action left icon input">
  			<i class="search icon"></i>
  			<input type="text" name="board_name" placeholder="검색">
  			<div class="ui teal button" onclick="document.getElementById('frm2').submit();"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">검색</font></font></div>
  		</div>
  	</form>
  </div>

  <div class="item">
   {{-- 페이지네이션 --}}
  	@if($pbas->count())
  	{{ $pbas->links() }}
  	@endif
  </div>

</div>


<div class="ui divider"></div>


<!-- 모달 -->
<div class="ui modal">
	<i class="close icon"></i>
	<div class="header">
			<i class="large edit icon"></i>
			작성하기
	</div>
	<div class="image content">
		<div class="image">
			<h3>PBA작성 또는 ASSY작성을 선택하여주세요.</h3>
		</div>
		<div class="description">
			<h3></h3>
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



							<button class="ui pink deny button"  onclick="location.href='/pbas/create'">PBA 작성</button>
							<button class="ui blue deny button" onclick="location.href='/assys/create'">ASSY 작성</button>

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

@stop
