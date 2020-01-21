@extends('master')

@section('content')

<h1>글 상세페이지</h1>
<div>

	{{ $post->title }}
</div>
<div>

	{{ $post->description }}
</div>

<div>
	<a href="/posts/{{ $post->id }}/edit">수정하기</a>
</div>

<form method="POST" action="/posts/{{ $post->id }}">
	@method('DELETE')
	@csrf
	<button type="submit">글 삭제</button>	
</form>

@endsection