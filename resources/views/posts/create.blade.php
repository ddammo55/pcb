@extends('master')

@section('content')

<h1>글 작성</h1>
<form class="ui form" method="POST" action="/posts">
	@csrf
	<div class="field">
		<input class="input {{ $errors->has('title') ? 'is-danger' : '' }}" type="text" name="title" value="{{ old('title') }}" placeholder="제목">
	</div>

	<div class="field">
		<textarea class="input {{ $errors->has('title') ? 'is-danger' : '' }}" name="description" value="{{ old('description') }}" placeholder="내용"></textarea>	
	</div>

	<div class="field">
		<button class="ui button" type="submit">글 작성</button>
	</div>
</form>

@if($errors->any())
<div class="ui pink inverted segment">

	<ul>	
		@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
</div>	
@endif	

@endsection