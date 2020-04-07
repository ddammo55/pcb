<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class TeamMembersController extends Controller
{
    public function show()
    {
    	$users = \App\User::all();
    	return view('auth.member',compact('users'));
    }

    public function member_modify(User $user)
    {
    	return view('auth.member_modify', compact('user'));
    }

    public function member_update(User $user)
    {
        //dd($user);
        //dd(request());
        $user->update(request(['name','email','level','Employee_number','position', 'date_of_entry', 'task']));

        return redirect('/member');
    }

    public function usertask()
    {
        $user1 = \App\User::where('name', '=', '채수단')->get();
        foreach ($user1 as $user1) {
            $user1 = $user1->profile_image;
        }
        if(!isset($user1)){
            $user1 = '';
        }

        $user2 = \App\User::where('name', '=', '최원호')->get();
        foreach ($user2 as $user2) {
            $user2 = $user2->profile_image;
        }
        if(!isset($user2)){
            $user2 = '';
        }

        $user3 = \App\User::where('name', '=', '신관식')->get();
        foreach ($user3 as $user3) {
            $user3 = $user3->profile_image;
        }
        if(!isset($user3)){
            $user3 = '';
        }

        $user4 = \App\User::where('name', '=', '이영호')->get();
        foreach ($user4 as $user4) {
            $user4 = $user4->profile_image;
        }
        if(!isset($user4)){
            $user4 = '';
        }

        $user5 = \App\User::where('name', '=', '문혁')->get();
        foreach ($user5 as $user5) {
            $user5 = $user5->profile_image;
        }
        if(!isset($user5)){
            $user5 = '';
        }

        $user6 = \App\User::where('name', '=', '고순선')->get();
        foreach ($user6 as $user6) {
            $user6 = $user6->profile_image;
        }
        if(!isset($user6)){
            $user6 = '';
        }


        $user7 = \App\User::where('name', '=', '홍성자')->get();
        foreach ($user7 as $user7) {
            $user7 = $user7->profile_image;
        }
        if(!isset($user7)){
            $user7 = '';
        }

        $user8 = \App\User::where('name', '=', '박향순')->get();
        foreach ($user8 as $user8) {
            $user8 = $user8->profile_image;
        }
        if(!isset($user8)){
            $user8 = '';
        }

        $user9 = \App\User::where('name', '=', '박찬숙')->get();
        foreach ($user9 as $user9) {
            $user9 = $user9->profile_image;
        }
        if(!isset($user9)){
            $user9 = '';
        }

        $user10 = \App\User::where('name', '=', '최정규')->get();
        foreach ($user10 as $user10) {
            $user10 = $user10->profile_image;
        }
        if(!isset($user10)){
            $user10 = '';
        }

        $user11 = \App\User::where('name', '=', '김진성')->get();
        foreach ($user11 as $user11) {
            $user11 = $user11->profile_image;
        }
        if(!isset($user11)){
            $user11 = '';
        }


        $user12 = \App\User::where('name', '=', '석세영')->get();
        foreach ($user12 as $user12) {
            $user12 = $user12->profile_image;
        }
        if(!isset($user12)){
            $user12 = '';
        }

        //dd($user2);

        //dd($user1);
        return view('auth.usertask', compact('user1','user2','user3','user4','user5','user6','user7','user8','user9','user10','user11','user12'));
    }
}
