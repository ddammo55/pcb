<?php

namespace App\Http\Controllers;

use DB;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectsRequest;
use RealRashid\SweetAlert\Facades\Alert;
class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($project_name_search = request('project_name_search')){

            $projects  = \App\Project::latest('id')->where('project_name', 'like' , '%'.$project_name_search.'%')->paginate(30);
        }else{

            $projects = \App\Project::latest('id')->paginate(25);
        }
        $projects_count = count(\App\Project::all());

       return view('projects.create',compact('projects','projects_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('projects.modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectsRequest $request)
    {
        Project::create(request(['project_name', 'project_code', 'car', 'kinds', 'note']));
        // Project::create([
        //     'project_name' => request('project_name'),
        //     'project_code' => request('project_code'),
        //     'car' => request('car'),
        //     'kinds' => request('kinds'),
        //     'note' => request('note'),

        // ]);
        Alert::success('입력완료', '프로젝트명이 작성되었습니다.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       dd($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
       // dd(request());
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project)
    {
       $project->update(request(['project_name', 'project_code', 'car', 'kinds', 'note']));
       Alert::success('수정완료', '프로젝트명이 수정되었습니다.');
        return redirect('/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //dd(request());
        if(request('DELETE') == 'DELETE'){
        $project->delete();
        Alert::success('삭제완료', '프로젝트명이 삭제되었습니다.');
        //echo "dd";
       return redirect('/projects');
        }else{
        return back();
        }
    }
}
