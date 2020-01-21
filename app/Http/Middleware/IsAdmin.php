<?php

namespace App\Http\Middleware;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       if (\Auth::user() &&  \Auth::user()->level >= 2) {
        return $next($request);
        }
        //echo "<script>alert(\"권한이 없습니다. 관리자에게 문의해 주세요.\");</script>";
        //return redirect('/login')->with('alert', '권한이 없습니다.');
        Alert::warning('권한이 없습니다.', '관리자에게 문의해주세요.');
        return redirect('/');
    }
}
