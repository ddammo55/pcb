@extends('master')

@section('content')

<div class="ui relaxed divided list">
	@foreach($posts as $post)

  <div class="item">
    <i class="play middle aligned icon">&nbsp;{{ $post->id }}</i>
    <div class="content"> <div class="right floated content">
      <div class="ui button"><font style="vertical-align: inherit;">더하다</font></div>
    </div>
      <a class="header"><font style="vertical-align: inherit;">
      	<a href="/posts/{{$post->id}}">
      	<h3>{{ $post->title }}</h3>
      	</a>
      </font>
      <div class="description"><font style="vertical-align: inherit;">{{ $post->description }}</font>
      </div>
    </div>
  </div>

@endforeach
</div>

{{-- 가로선 --}} 
<div class="ui clearing divider"></div>

	<form method="get" action="/posts/create" style="margin-bottom: 10px;">
		<button class="ui teal button" type="submit">
			글 작성하기
		</button>
	</form>



{{-- 페이지네이션 --}}
@if($posts->count())
	{{ $posts->links() }}
@endif


@endsection