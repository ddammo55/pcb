<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
	public function cookie(Request $request)
	{
    	//동일한 이름을 가진 cookie의 내용을 가져온다.
		$value = $request->cookie('cookie');

		return view('cookie/cookie') -> with('cookie',$value);
	}

	public function cookie_ok(Request $request)
	{
   		
   		//form에서 받은 cookie 값
   		$value = $request->input('cookie');
         	$response = new Response($value);
   		//쿠키 설정시간
   		// 1/60 (1초)
   		$minutes = 20/60;
   		//cookie를 셋팅 한다
         	//cookie('이름','내용','시간')
         	$response -> withCookie(cookie('cookie',$response,$minutes));
 
        	 return $response;
   	}
}
