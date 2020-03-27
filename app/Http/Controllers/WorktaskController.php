<?php

namespace App\Http\Controllers;

use App\Workplan;
use App\Worktask;
use Illuminate\Http\Request;

class WorktaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Workplan $workplan)
    {
        //dd('dd');
        		// 유효성검사
		//$attributes = request()->validate(['description' => 'required']);
		//$pba->addTask($attributes);
        //dd($workplan->id);
		//dd($pba);
		Worktask::create([
			'workplan_id' => $workplan->id,
			'process' => strtoupper(request('process')),
			'description' => request('description'),
			'wt' => request('wt'),
			'wr_user' => auth()->user()->name //입력한 사용자
		]);

		return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Worktask  $worktask
     * @return \Illuminate\Http\Response
     */
    public function show(Worktask $worktask)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worktask  $worktask
     * @return \Illuminate\Http\Response
     */
    public function edit(Worktask $worktask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worktask  $worktask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worktask $worktask)
    {
       //dd(request()->all());
       $worktask->update([
    		'completed' => request()->has('completed')
    	]);

    	return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worktask  $worktask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worktask $worktask)
    {
        //
    }
}
