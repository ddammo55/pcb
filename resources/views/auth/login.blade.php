@extends('master')

@section('content')

<div class="ui two column centered grid">
    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <h2 class="ui teal image header">
                <img src="/images/logo.png" class="image">
                <div class="content">
                    당신의 계정에 로그인 하십시오.
                </div>
            </h2>
            <form class="ui large form" action="{{route('login')}}" method="POST">
                @csrf
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail 주소">
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>



                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="패스워드">
                        </div>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="ui checkbox">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('기억하기') }}
                        </label>
                    </div>





                    <div>
                        <button class="ui fluid large teal submit button" type="submit">
                            로그인 하기
                        </button>
                    </div>
                </div>

                <div class="ui error message"></div>

            </form>

            <div class="ui message">
                처음이신가요? &nbsp;<a href="{{ route('register') }}">회원가입</a>
            </div>

            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('비밀번호를 분실하였나요?') }}
            </a>
            @endif
        </div>
    </div>
</div>


{{-- <div class="ui equal width grid">
    <div class="column">
        <!-- -->
    </div>
    <div class="eight wide column">
                <div class="column">
            <h2 class="ui teal image header">
                <img src="/images/logo.png" class="image">
                <div class="content">
                    당신의 계정에 로그인 하십시오.
                </div>
            </h2>
            <form class="ui large form" action="{{route('login')}}" method="POST">
                @csrf
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="email" placeholder="E-mail 주소">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="패스워드">
                        </div>
                    </div>
                    <div>
                        <button class="ui fluid large teal submit button" type="submit">
                            로그인 하기
                        </button>
                    </div>
                </div>

                <div class="ui error message"></div>

            </form>

            <div class="ui message">
                처음이신가요? &nbsp;<a href="{{ route('register') }}">회원가입</a>
            </div>

            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('비밀번호를 분실하였나요?') }}
            </a>
            @endif
        </div>

    </div>
    <div class="column">
        <!-- -->
    </div>
</div> --}}




@stop