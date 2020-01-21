@extends('master')

@section('content')

	<h1>글 수정</h1>
	<form method="POST" action="/posts/{{ $post->id }}">
		@csrf
		@method('PATCH')
		<div>
			<input type="text" name="title"  value="{{ $post->title }}">
		</div>

		<div>
			<textarea name="description">{{ $post->description }}</textarea>	
		</div>

		<div>
			<button type="submit">글 수정</button>
		</div>
	</form>

@endsection