<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{

#|--------------------------------------------------------------------------
#| 유저 로그인
#|--------------------------------------------------------------------------
  public function create()
  {
    return view('users_login');
  }

  public function store(Request $request)
  {
    //dd($request);
    return 'session store';
    // $this->validate($request,[
    //   'email'=> 'required|email',
    //   'password'=> 'required|min:6',
    // ]);
    
    // if (! auth()->attempt($request->only('email','password'), $request->has('remeber'))){
    //   flash('이메일 또는 비밀번호가 맞지 않습니다.');
    // }

    // flash(auth()->user()->name . '님. 환영합니다.');

    // return redirect()->intended('/');
  }

#|--------------------------------------------------------------------------
#| 유저 로그아웃
#|--------------------------------------------------------------------------
  public function destroy()
  {
    auth()->logout();
    flash('또 방문해 주세요');

    return redirect('/');
  }

}
