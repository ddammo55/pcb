@extends('master')

@section('content')

<h1>유저 수정 페이지</h1>


<div class="ui four column grid">
  <div class="two column row">
    <div class="column">

    	<form class="ui form" method="POST" action="/member_modify/{{ $user->id }}">
    		        @csrf
       				@method('PATCH')
    		<div class="field">
    				<label>이름</label>
    				<div  class="ui disabled input">
    				<input type="text" name="name" value="{{ $user->name }}">
    			</div>
    		</div>

    		<div class="field">
    			<label>이메일</label>
    			<input type="text" name="email" value="{{ $user->email }}">
    		</div>

            <div class="field">
              <div class="ui selection dropdown">
                <input class="input {{ $errors->has('level') ? 'is-danger' : '' }}" type="hidden" name="level" value="{{ $user->level }}" placeholder="레벨" required>
                <i class="dropdown icon"></i>
                <div class="default text" style="color: black">레벨</div>
                <div class="menu">
                  <div class="item">1</div>
                  <div class="item">2</div>
                  <div class="item">3</div>
                </div>
              </div>
            </div>

    		<div class="field">
    			<label>사원번호</label>
    			<input type="text" name="Employee_number" value="{{ $user->Employee_number }}">
    		</div>

    		<div class="field">
    			<label>직급</label>
    			<input type="text" name="position" value="{{ $user->position }}">
    		</div>

    		<div class="field">
    			<label>입사일</label>
    			<input type="date" name="date_of_entry" value="{{ $user->date_of_entry }}">
    		</div>

    		<div class="field">
    			<label>담당업무</label>
    			<input type="text" name="task" value="{{ $user->task }}">
    		</div>

    		<br>

    		<button class="ui teal button" type="submit">작성완료</button>

    	</form>

    </div>
  </div>
  <div class="column"></div>
  <div class="column"></div>
  <div class="column"></div>
  <div class="column"></div>
</div>




@endsection
