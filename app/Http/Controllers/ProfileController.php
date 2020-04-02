<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use App\Worktask;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user()->name; //로그인자
        $works = Worktask::latest()->where('wr_user' ,'=', $user)->get();

        //dd($works);

        return view('auth.profile',compact('works'));
    }

    public function updateProfile(Request $request)
    {
        // Form validation
        $request->validate([
            'name'              =>  'required',
            'profile_image'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Get current user
        $user = User::findOrFail(auth()->user()->id);
        // Set user name
        $user->name = $request->input('name');

        // Check if a profile image has been uploaded
        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }
        // Persist user record to database
        $user->save();

        // Return user back and show a flash message
        Alert::success('저장', '저장이 완료 되었습니다.');
        return redirect()->back();
        //return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }

    public function edit(Worktask $worktask)
    {
        return view('auth.worktask_edit',compact('worktask'));
    }

    public function editTo(Worktask $worktask, Request $request)
    {
        //dd($worktask);
        $worktask->update(
            [
                'process' => strtoupper(request('process')),
                'wt' => request('wt')
            ]
        );


        Alert::success('수정 완료', '수정이 완료 되었습니다.');
        return redirect('/profile');
    }

    public function destroy(Worktask $worktask)
    {
        //dd('삭제');
        $worktask->delete();

       return redirect('/profile');
    }

}
