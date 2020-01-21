@extends('master')

@section('content')




@foreach($pbas_cas as $pbas_ca)
	<div class="ui label" style="margin-bottom: 0.5em"><a href="/pbas/{{ $pbas_ca[0]->id }}">{{ $pbas_ca[0]->project_name }}</a></div>

@endforeach



<div class="ui divider"></div>

{{-- 페이지네이션 --}}
@if($pbas->count())
{{ $pbas->links() }}
@else
{{ 123 }}
@endif


<div class="ui divider"></div>


<div class="ui five column stackable padded grid">
	@foreach($pbas as $pba)
  <div ><div class="ui message" style="padding: 0.2em 1em;">
		<div class="ui very relaxed items" style="margin: 0.5em 0em;">
			
			<div class="item" style="margin: 0.5em 0em;">
					

				<div class="image">
					<?php
					$contents = $pba->content;
					 
					preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", stripslashes($contents), $matches); 
					
					//http://tiny.test/photos/shares/Desert.jpg
					//http://tiny.test/photos/shares/thumbs/Desert.jpg
					
					print_r($matches[0][0]);
					
					?>  
				
				
					<div class="ui divider"></div>
					<p><a href="/pbas/{{$pba->id}}/edit">보드명 : CONT250-C3</a></p>
					<p>등록일 : 2019-05-09</p>
					<p>등록자 : 홍길동</p>
				</div>
					

			</div>
		</div>
	</div></div>
  @endforeach
</div>

<div class="ui divider"></div>

<form method="get" action="/pbas/create" style="margin-bottom: 10px;">
	<button class="ui teal button" type="submit">
		글 작성하기
	</button>
</form>

@stop