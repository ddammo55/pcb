<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $this->validate($request,[
          'email'=> 'required|email',
          // 'password'=> 'required|min:6',
      ]);

    if (!auth()->attempt($request->only('email','password'), $request->has('remember'))){
        // if(session('success_message')){
          Alert::warning('죄송합니다.', '이메일 또는 비밀번호가 맞지 않습니다.');
        // }
          return back()->withInput();
      }

      // 로그인하면 보여지는 메세지
      //flash(auth()->user()->name . '님 환영합니다.'.'<br>'.'회원님은 '.date("Y년 m월 d일 h시 i분").'에 계정 접속 하였습니다.'.'<br>'.'오늘도 즐거운 하루 보내세요^^');
      Alert::image(auth()->user()->name .'님 오늘도 파이팅해주세요^^',date("Y년 m월 d일 h시 i분"),'./images/login_image.png');
      //Alert::warning(auth()->user()->name .'반갑습니다.', '오늘도 즐거운 하루 보내세요^^');
      return redirect()->intended('profile');
    }

    public function logout(){
            auth()->logout();
    Alert::success('수고하셨습니다.', '');

    //flash('또 방문해 주세요');

    return redirect('/');
    }


}
