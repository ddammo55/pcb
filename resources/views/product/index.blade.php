@extends('master')

@section('content')

<div class="ui relaxed divided list">
	@foreach($products as $product)

  <div class="item">
    <i class="play middle aligned icon">&nbsp;{{ $product->id }}</i>
    <div class="content"> <div class="right floated content">
      <div class="ui button"><font style="vertical-align: inherit;">더하다</font></div>
    </div>
      <a class="header"><font style="vertical-align: inherit;">
      	<a href="/products/{{$product->id}}">
      	<h3>{{ $product->serial_name }}</h3>
      	</a>
      </font>
      <div class="description"><font style="vertical-align: inherit;">{{ $product->board_name }}</font>
      </div>
    </div>
  </div>

@endforeach
</div>

{{-- 가로선 --}} 
<div class="ui clearing divider"></div>

	<form method="get" action="/products/create" style="margin-bottom: 10px;">
		<button class="ui teal button" type="submit">
			글 작성하기
		</button>
	</form>



{{-- 페이지네이션 --}}
@if($products->count())
	{{ $products->links() }}
@endif


@endsection