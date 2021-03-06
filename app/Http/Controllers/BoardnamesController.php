<?php

namespace App\Http\Controllers;
//use App\Http\Requests;
use App\Boardname;
use Illuminate\Http\Request;
use App\Http\Requests\BoardnameRequest;
use RealRashid\SweetAlert\Facades\Alert;
class BoardnamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if($board_name_search = request('board_name_search')){

            $boardnames  = \App\Boardname::latest('id')->where('boardname', 'like' , '%'.$board_name_search.'%')->paginate(30);
        }else{

            $boardnames = \App\Boardname::latest('id')->paginate(25);
        }
        //[보드명 목록과 보드명 작성하기]

        $boardnames_count = count(\App\Boardname::all());

        return view('boardnames.create',compact('boardnames','boardnames_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardnameRequest $request)
    {
        //[보드명 작성하기 데이터 삽입]
        //dd($request);
       $method = strtoupper(request('method'));
       Boardname::create([
            'boardname' => request('boardname'),
            'top_num' => request('top_num'),
            'bot_num' => request('bot_num'),
            'man_hour' => request('man_hour'),
            'top_method' => request('top_method'),
            'bot_method' => request('bot_method'),
            'metal_mask_no' => request('metal_mask_no'),
            'dwg_no' => request('dwg_no'),
            'method' => $method,
            'note' => request('note'),
        ]);
        // request(['boardname', 'top_num', 'bot_num',  $method , 'note']));
        Alert::success('입력완료', '보드명이 작성되었습니다.');
       return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Boardname  $boardname
     * @return \Illuminate\Http\Response
     */
    public function show(Boardname $boardname)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Boardname  $boardname
     * @return \Illuminate\Http\Response
     */
    public function edit(Boardname $boardname)
    {
        return view('boardnames.edit', compact('boardname'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Boardname  $boardname
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Boardname $boardname)
    {

        $method = strtoupper(request('method'));
       $boardname->update([
            'boardname' => request('boardname'),
            'top_num' => request('top_num'),
            'bot_num' => request('bot_num'),
            'man_hour' => request('man_hour'),
            'top_method' => request('top_method'),
            'bot_method' => request('bot_method'),
            'metal_mask_no' => request('metal_mask_no'),
            'dwg_no' => request('dwg_no'),
            'method' => $method,
            'note' => request('note'),
        ]);

        Alert::success('수정완료', '보드명이 수정되었습니다.');
       return redirect('/boardnames');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Boardname  $boardname
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boardname $boardname)
    {
        //dd(request());
        if(request('DELETE') == 'DELETE'){
        $boardname->delete();
        Alert::success('삭제완료', '보드명이 삭제되었습니다.');
        //echo "dd";
       return redirect('/boardnames');
        }else{
        return back();
        }
    }
}
