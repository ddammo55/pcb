<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Pba;

class PbaTasksController extends Controller
{

	public function store(Pba $pba)
	{
		// 유효성검사
		$attributes = request()->validate(['description' => 'required']);
		//$pba->addTask($attributes);
		
		//dd($pba);
		Task::create([
			'pba_id' => $pba->id,
			'description' => request('description'),
			'wr_user' => auth()->user()->name,
		]);

		return back();
	}


    public function update(Task $task)
    {
    	//dd(request()->all());
    	$task->update([
    		'completed' => request()->has('completed')
    	]);

    	return back();
    }
}
