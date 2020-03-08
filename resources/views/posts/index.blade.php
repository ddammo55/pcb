@extends('master')

@section('content')

<h1>실시간 작업 리스트 & 공수입력
    @if(Auth::check())
    @if(auth()->user()->level >= 3)
    <a class="ui primary button" href="/posts/create">추가하기</a>
    @endif
    @endif
</h1>

<div class="ui relaxed divided list">
    @foreach($posts as $post)

    <div class="item">
        <i class="play middle aligned icon">&nbsp;{{ $post->id }}</i>
        <div class="content">
            <div class="right floated content">
                <div class="ui button">
                    <font style="vertical-align: inherit;">더하다</font>
                </div>
            </div>
            <a class="header">
                <font style="vertical-align: inherit;">
                    <a href="/posts/{{$post->id}}">
                        <h3>{{ $post->title }}</h3>
                    </a>
                </font>
                <div class="description">
                    <font style="vertical-align: inherit;">{{ $post->description }}</font>
                </div>
        </div>
    </div>

    @endforeach
</div>


{{-- 페이지네이션 --}}
@if($posts->count())
{{ $posts->links() }}
@endif

<br>
<br>

@endsection
