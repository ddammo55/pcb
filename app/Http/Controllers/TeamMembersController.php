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
        $user->update(request(['name','email','level','Employee_number','position', 'date_of_entry', 'task']));
 
        return redirect('/member');
    }
}
