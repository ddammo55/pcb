@extends('master')

@section('content')

<h1>유저 리스트 페이지</h1>

<table class="ui very basic collapsing celled table">
  <thead>
    <tr><th>NO</th>
    <th>이름</th>
    <th>이메일</th>
    <th>레벨</th>
    <th>사원번호</th>
    <th>직급</th>
    <th>입사일</th>
    <th>담당업무</th>
    <th>수정</th>
  </tr></thead>
  <tbody>
  	<?php $i=1?>
@foreach( $users as $user)
    <tr>
   			<td>{{ $i }}</td>

	      <td>
	        <h4 class="ui image header">
	          <img src="{{ $user->profile_image }}" class="ui mini rounded image">
	          <div class="content">
	           {{ $user->name }}
	            <div class="sub header">Human Resources
	          </div>
	        </div>
	      </h4>
	  	  </td>

	  	  <td>{{ $user->email }}</td>
	  	  <td>{{ $user->level }}</td>
	  	  <td>{{ $user->Employee_number }}</td>
	  	  <td>{{ $user->position }}</td>
	  	  <td>{{ $user->date_of_entry }}</td>
	  	  <td>{{ $user->task }}</td>
	  	  <td>


		  	  	<form method="POST" action="/member_modify/{{ $user->id }}/edit">
		  	  		@csrf
		  	  	
		  	  		
		  	  		<div>
		  	  			<button class="ui teal button" type="submit">수정</button>
		  	  		</div>
		  	  	</form>

	  	  </td>
	  	 
    </tr>
    <?php $i++?>
@endforeach


  </tbody>
</table>





@endsection