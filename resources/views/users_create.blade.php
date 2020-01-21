@extends('master')

@section('content')

<div class="ui equal width grid">
  <div class="column">
    <!-- -->
  </div>
  <div class="eight wide column">
    <div class="ui segment">
      <h2 class="ui teal image header">
        <img src="/images/logo.png" class="image">
        <div class="content">
          회원가입을 하십시오.
        </div>
      </h2>
      <form action="{{ route('register') }}" method="POST" role="form" class="ui form">
       @csrf

       <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <input type="text" name="name" class="form-control" placeholder="이름" value="{{ old('name') }}" autofocus/>
        {!! $errors->first('name', '<span class="form-error">:message</span>') !!}
      </div>

      <div class="field {{ $errors->has('email') ? 'has-error' : '' }}">
        <input type="email" name="email" class="form-control" placeholder="이메일" value="{{ old('email') }}"/>
        {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
      </div>

      <div class="field {{ $errors->has('password') ? 'has-error' : '' }}">
        <input type="password" name="password" class="form-control" placeholder="비밀번호 6자리 이상"/>
        {!! $errors->first('password', '<span class="form-error">:message</span>') !!}
      </div>

      <div class="field {{ $errors->has('password') ? 'has-error' : '' }}">
        <input type="password" name="password_confirmation" class="form-control" placeholder="비밀번호 확인 6자리 이상" />
        {!! $errors->first('password_confirmation', '<span class="form-error">:message</span>') !!}
      </div>


      @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

      
      <div class="field">
        <button class="ui button" type="submit">
          가입하기
        </button>
      </div>
    </form>
  </div>
</div>
<div class="column">
 <!-- -->
</div>
</div>

@stop
