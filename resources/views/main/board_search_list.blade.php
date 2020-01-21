@extends('master')

@section('content')

<h1>보드명 검색 {{ $products_count }}</h1>

 <div> <a href="{{ route('toto') }}" class="ui teal button">Export</a></div>

<div class="ui four column grid">
	<div class="row">
		<div class="column">
			<form class="ui form" method="get" action="boardSearchList">
				@csrf
				<div class="field">
					<div class="ui selection dropdown">
						<input type="hidden" name="board_name_choice" value="{{ $board_name_search }}">
						<i class="dropdown icon"></i>
						<div class="default text" style="color: black">보드명</div>




						<div class="menu">
							@foreach($board_names as $board_name)
							<div class="item">{{ $board_name->boardname }}</div>
							@endforeach
						</div>

					</div>
				</div>

			</div>


			<div class="column">

				<div>
					<div class="ui input">시작날짜<input type="date" name="start_date" value="{{ $start_date }}"></div>

				</div>
			</div>

			<div class="column">
				<div>
					<div class="ui input">마지막날짜<input type="date" name="end_date" value="{{ $end_date }}"></div>
				</div>
			</div>

			<div class="field">
				<button class="ui teal button" type="submit">검색</button>
			</div>

		</form>

	</div>
</div>



<div class="ui divider"></div>

@include('main.table', $products)




@endsection
