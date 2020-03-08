<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

#|--------------------------------------------------------------------------
#| 게시판 메인가기
#|--------------------------------------------------------------------------
    public function index()
    {
       $posts = \App\Post::latest()->paginate(15);

       return view('posts.index',compact('posts'));
    }

#|--------------------------------------------------------------------------
#| 게시판 글쓰기 가기
#|--------------------------------------------------------------------------

        public function create()
        {
            //프로젝트명 가져오기
            $project_lists = \App\Project::get();

            //보드명 가져오기
            $board_names = \App\Boardname::all();


            return view('posts.create', compact('project_lists','board_names'));
        }


#|--------------------------------------------------------------------------
#| 게시판 글 유효성검사, 데이터베이스에 등록하기
#|--------------------------------------------------------------------------
    public function store(Request $request)
    {

        $rules = [
            'title' => ['required'],
            'description' => ['required', 'min:4'],
        ];

        $messages = [
            'title.required' => '제목은 필수 입력 항목입니다.',
            'description.required' => '본문은 필수 입력 항목입니다.',
            'min' => '본문은 4자 이상 필수 항목입니다.',

        ];

         $validator = \Validator::make($request->all(), $rules, $messages);

         if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        Post::create(request()->validate([
            'title' => ['required','min:3'],
            'description' => ['required','min:3'],
        ]));

        return redirect('/posts');
    }

#|--------------------------------------------------------------------------
#| 게시판 글 상세 페이지
#|--------------------------------------------------------------------------
    public function show(Post $post)
    {
        dd($post);
        return view('posts.show',compact('post'));
    }

#|--------------------------------------------------------------------------
#| 게시판 글 수정 페이지
#|--------------------------------------------------------------------------
    public function edit(Post $post)
    {
        dd($post);
        return view('posts.edit',compact('post'));
    }

#|--------------------------------------------------------------------------
#| 게시판 글 데이터베이스에 등록하기
#|--------------------------------------------------------------------------
    public function update(Request $request, Post $post)
    {
        $post->update(request(['title','description']));

        return redirect('/posts');
    }


#|--------------------------------------------------------------------------
#| 게시판 글 삭제하기
#|--------------------------------------------------------------------------
    public function destroy(Post $post)
    {
       $post->delete();

       return redirect('/posts');
    }
}
