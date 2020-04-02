@extends('master')

@section('content')

{{-- 회원사진 --}}
{{-- <form action="{{ route('profile.update') }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf

    <div class="ui light card">
      <div class="image">
        <a class="ui blue right corner label">
          <h4 class="ui right aligned header" style="padding: 8px; color: white">
        {{ auth()->user()->level }}
         </h4>
      </a>
        <img src="{{ (auth()->user()->profile_image) }}">
    </div>
    <div class="content">
      <a class="header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{Auth()->user()->name}}
       @if(Auth()->user()->position)
       {{ Auth()->user()->position }}</font></font></a>
       @else
        {{ '' }} </font></font></a>
       @endif
    </div>
    <div class="extra content">
        <span style="margin-bottom: 5px;">
          <i class="users icon"></i>

            {!! strtolower(auth()->user()->email) !!}

        </span>

        <input id="name" type="hidden"  name="name" value="{{ old('name', auth()->user()->name) }}">
        <input id="email" type="hidden"  name="email" value="{{ old('email', auth()->user()->email) }}" disabled>

        <input id="profile_image" type="file" class="form-control" name="profile_image" value="사진업로드" style="margin-top: 5px;">

        <button type="submit" style="margin-top: 5px;">사진 업로드</button>
    </div>
    </div>
</form> --}}
{{-- 회원사진 --}}



<div class="ui internally celled grid">
  <div class="row">
    <div class="three wide column">

      {{-- 회원사진 --}}
<form action="{{ route('profile.update') }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf

    <div class="ui light card" style="margin-top: -0.5px">
      <div class="image">
        <a class="ui blue right corner label">
          <h4 class="ui right aligned header" style="padding: 8px; color: white">
        {{ auth()->user()->level }}
         </h4>
      </a>
        <img src="{{ asset(auth()->user()->image) }}">
    </div>

    <div class="extra content">
        <span style="margin-bottom: 5px;">
          <i class="users icon"></i>

            {!! strtolower(auth()->user()->email) !!}

        </span>

        <input id="name" type="hidden"  name="name" value="{{ old('name', auth()->user()->name) }}">
        <input id="email" type="hidden"  name="email" value="{{ old('email', auth()->user()->email) }}" disabled>

        <input id="profile_image" type="file" class="form-control" name="profile_image" value="사진업로드" style="margin-top: 5px;">

        <button type="submit" style="margin-top: 5px;">사진 업로드</button>
    </div>
    </div>
</form>
{{-- 회원사진 --}}

    </div>
    <div class="ten wide column">

      <div class="ui segment">
        <h2>{{Auth()->user()->name}}</h2>
      </div>

      <table class="ui definition table">
        <tbody>
          <tr>
            <td class="two wide column" style="padding: 10px; padding-left: 7px;">이메일</td>
            <td  style="padding-left: 7px;">{{ Auth()->user()->email }}</td>
          </tr>
          <tr>
            <td class="two wide column" style="padding: 10px; padding-left: 7px;">사원번호</td>
            <td  style="padding-left: 7px;">{{ Auth()->user()->Employee_number }}</td>
          </tr>
          <tr>
            <td style="padding: 10px"; style="padding-left: 7px;">직급</td>
            <td style="padding-left: 7px;">{{ Auth()->user()->position }}</td>
          </tr>
          <tr>
            <td style="padding: 10px"; style="padding-left: 7px;">입사일</td>
            <td style="padding-left: 7px;">{{ Auth()->user()->date_of_entry }}</td>
          </tr>
          <tr>
            <td style="padding: 10px"; style="padding-left: 7px;">담당업무</td>
            <td style="padding-left: 7px;">{{ Auth()->user()->task }}</td>
          </tr>
        </tbody>
      </table>

    </div>
    <div class="three wide column">

      <div style="display: table; margin-left: auto; margin-right: auto;">

          <h2 class="ui inverted header" style="padding-top: 100px;">
            <h1>LV&nbsp;{{ Auth()->user()->level }}</h1>
            <div class="sub header"></div>
          </h2>

      </div>

    </div>
  </div>

</div>

<div class="ui divider"></div>

<h3>최근 공수입력현황</h3>

<table class="ui celled table">
    <thead>
        <tr><th>NO</th>
            <th>작업지시번호</th>
            <th>제목</th>
            <th>프로젝트명</th>
            <th>프로젝트코드</th>
            <th>보드명</th>
            <th>assy</th>
            <th>수량</th>
            <th>공정명</th>
            <th>작성일</th>
            <th>공수</th>
            <th>버튼</th>
        </tr></thead>
        <tbody>
            <?php $i=1?>
            @foreach($works as $work)
      <tr>
        <td data-label="Name">{{$i}}</td>
        <td data-label="Age">{{$work->workplan->work_no}}</td>
        <td data-label="Age">{{$work->workplan->title}}</td>
        <td data-label="Age">{{$work->workplan->project_name}}</td>
        <td data-label="Age">{{$work->workplan->project_code}}</td>
        <td data-label="Age">{{$work->workplan->board_name}}</td>
        <td data-label="Age">{{$work->workplan->assy}}</td>
        <td data-label="Age">{{$work->workplan->ea}}</td>
        <td data-label="Age">{{$work->process}}</td>
        <td data-label="Age">{{$work->created_at->format('m-d')}}</td>
        <td data-label="Job">{{$work->wt }}</td>
        <td data-label="Job">

            <form method="post">
                @csrf
                @method('PATCH')
            <button class="ui orange button" type="submit" value="완료" formaction="/profile/edit/{{$work->id}}">
                수정
            </button>
            </form>


        </td>
      </tr>
      <?php $i++ ?>
    @endforeach
    </tbody>
  </table>



@endsection
