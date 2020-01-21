@extends('master')

@section('content')

<div class="ui segment">
  <div class="ui two column very relaxed grid">
    <div class="five wide column">
        <h1>보드명 작성 ({{ $boardnames_count }}종)</h1>
    	<form class="ui form" method="POST" action="/boardnames">
    		@csrf
            <div class="field">
    			<input class="input {{ $errors->has('boardname') ? 'is-danger' : '' }}" type="text" name="boardname" value="{{ old('boardname') }}" placeholder="보드 명" required>
    		</div>	

    		<div class="field">
    			<input class="input {{ $errors->has('top_num') ? 'is-danger' : '' }}" type="number" name="top_num" value="{{ old('top_num') }}" placeholder="TOP 부품수량" required>
    		</div>	

    		<div class="field">
    			<input class="input {{ $errors->has('bot_num') ? 'is-danger' : '' }}" type="number" name="bot_num" value="{{ old('bot_num') }}" placeholder="BOT 부품수량" required>
    		</div>

            <div class="field">
                <input class="input {{ $errors->has('man_hour') ? 'is-danger' : '' }}" type="number" name="man_hour" value="{{ old('man_hour') }}" placeholder="공수">
            </div>

            <div class="field">
              <div class="ui selection dropdown">
                <input class="input {{ $errors->has('method') ? 'is-danger' : '' }}" type="hidden" name="method" value="{{ old('method') }}" placeholder="방법" required>
                <i class="dropdown icon"></i>
                <div class="default text" style="color: black">작업방법</div>
                <div class="menu">
                  <div class="item">SMD</div>
                  <div class="item">DIP</div>
                  <div class="item">AS</div>
                  <div class="item">외주</div>
                  <div class="item">코팅</div>
                  <div class="item">조립</div>
                </div>
              </div>
            </div>

            <div class="field">
              <div class="ui selection dropdown">
                <input class="input {{ $errors->has('top_method') ? 'is-danger' : '' }}" type="hidden" name="top_method" value="{{ old('top_method') }}" placeholder="방법" required>
                <i class="dropdown icon"></i>
                <div class="default text" style="color: black">TOP소재</div>
                <div class="menu">
                  <div class="item">크림솔더</div>
                  <div class="item">본드</div>
                </div>
              </div>
            </div>

            <div class="field">
              <div class="ui selection dropdown">
                <input class="input {{ $errors->has('bot_method') ? 'is-danger' : '' }}" type="hidden" name="bot_method" value="{{ old('bot_method') }}" placeholder="방법" required>
                <i class="dropdown icon"></i>
                <div class="default text" style="color: black">BOT소재</div>
                <div class="menu">
                  <div class="item">본드</div>
                  <div class="item">크림솔더</div>
                </div>
              </div>
    		</div>

            <div class="field">
                <input class="input {{ $errors->has('metal_mask_no') ? 'is-danger' : '' }}" type="number" name="metal_mask_no" value="{{ old('metal_mask_no') }}" placeholder="메탈마스크 넘버" required>
            </div>

            <div class="field">
                <input class="input {{ $errors->has('dwg_no') ? 'is-danger' : '' }}" type="text" name="dwg_no" value="{{ old('dwg_no') }}" placeholder="도면번호" required>
            </div>

            <div class="field">
                <input class="input {{ $errors->has('note') ? 'is-danger' : '' }}" type="text" name="note" value="{{ old('note') }}" placeholder="메모">
            </div>



    		<div class="field">
    			<button class="ui button" type="submit">보드명 작성</button>
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
    </div>
    <div class="eleven wide column">
    	<table class="ui celled table">

    		<thead>
    			<tr>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ID</font></font></th>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">보드명</font></font></th>
    				<th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">TOP 부품수량</font></font></th>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">BOT 부품수량</font></font></th>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">공수(분)</font></font></th>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">TOP소재</font></font></th>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">BOT소재</font></font></th>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">메탈마스크넘버</font></font></th>
    				<th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">도면넘버</font></font></th>
    				<th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">방법</font></font></th>
    				<th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">메모</font></font></th>
    			</tr>
            </thead>
    			<tbody>
    					@foreach ($boardnames as $boardname)
    				<tr>
    					<td>{!! $boardname->id!!}</td>
    					<td><a href="/boardnames/{{ $boardname->id }}/edit">{{$boardname->boardname}}</a></td>
    					<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! $boardname->top_num!!}</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! $boardname->bot_num!!}</font></font></td>
    					<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! $boardname->man_hour!!}</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! $boardname->top_method!!}</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! $boardname->bot_method!!}</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! $boardname->metal_mask_no!!}</font></font></td>
                        <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! $boardname->dwg_no!!}</font></font></td>
    					<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! $boardname->method!!}</font></font></td>
    					<td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! $boardname->note!!}</font></font></td>
    				</tr>
    						@endforeach
    	
    	
    
    	 </tbody>
    </table>

    {{-- 페이지네이션 --}}
@if($boardnames->count())
	{{ $boardnames->links() }}
@endif
    </div>
  </div>

</div>




@endsection