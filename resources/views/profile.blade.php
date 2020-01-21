@extends('master')


@section('content')


<div class="ui centered card">
  <div class="image">
    <img src="/images/elyse.png">
  </div>
  <div class="content">
    <a class="header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{Auth()->user()->name}}</font></font></a>
  </div>
  <div class="extra content">
    <a>
      <i class="users icon"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        {{Auth()->user()->email}}
      </font></font></a>

      <br>
      <a class="btn btn-link" href="{{ url('/password/reset') }}">
        {{ __('비밀번호를 재설정') }}
      </a>
    </div>
  </div>  

  @endsection
