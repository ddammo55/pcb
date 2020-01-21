<?php

namespace App\Http\Controllers;

use App\Pba;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\PbaRequest;

class PbasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pba $pba)
    {
        //찾기 검색
        $board_name = request('board_name');
        
        if($board_name){

        // 보드명만 찾기
        $pbas = \App\Pba::where('board_name', 'like' , '%'.$board_name.'%')->paginate(50);

        // 찾는 보드 수량 찾기
        $pbas_counts = count($pbas);
        }else{

        //PBA 리스트 불러오기
        $pbas = \App\Pba::latest('id')->paginate(12);

        //프로젝트 수량 불러오기
        $pbas_counts =  \App\Pba::all()->count();
    }
    
        //프로젝트 카테고리 불러오기
        $pbas_cas =  \App\Pba::get()->groupBy('project_name');

        //값 넘기기
        return view('pbas.list', compact('pbas','pbas_cas', 'pbas_counts'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        #|--------------------------------------------------------------------------
        #| 보드명
        #|--------------------------------------------------------------------------
        $pcb_lists = \App\Boardname::get();

        #|--------------------------------------------------------------------------
        #| 프로젝트명
        #|--------------------------------------------------------------------------
        $project_lists = \App\Project::get();

        return view('pbas.create',compact('pcb_lists', 'project_lists'));
    }

    public function assycreate()
    {
        #|--------------------------------------------------------------------------
        #| 보드명
        #|--------------------------------------------------------------------------
        $pcb_lists = \App\Boardname::get();

        #|--------------------------------------------------------------------------
        #| 프로젝트명
        #|--------------------------------------------------------------------------
        $project_lists = \App\Project::get();

        return view('pbas.assy_create',compact('pcb_lists', 'project_lists'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PbaRequest $request) //pba입력처리
    {
        //dd(request()->all());
        Pba::create([
            'board_name' => request('board_name'),
            'project_name' => request('project_name'),
            'content' => request('content'),
            'division' => request('division'),
            'wr_user' => auth()->user()->name, //입력한 사용자
        ]);
        // request(['boardname', 'top_num', 'bot_num',  $method , 'note']));
       flash('입력이 정상적으로 처리되었습니다.');
       return redirect('/pbas');
    }


    public function storeassy(PbaRequest $request) //assy입력처리
    {
        //return "assycreate";
        //dd(request()->all());
        Pba::create([
            'assy_name' => request('assy_name'),
            'project_name' => request('project_name'),
            'content' => request('content'),
            'division' => request('division'),
            'wr_user' => auth()->user()->name, //입력한 사용자
        ]);
        // request(['boardname', 'top_num', 'bot_num',  $method , 'note']));
       flash('입력이 정상적으로 처리되었습니다.');
       return redirect('/pbas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pba  $pba
     * @return \Illuminate\Http\Response
     */
    public function show(Pba $pba)  //카테고리 클릭했을 때의 로직 
    {
        //dd($pba->project_name);
        $project_name = $pba->project_name;

        $pbas = \App\Pba::where('project_name', $project_name)->paginate(14);

        //$pbas = \App\Pba::where('project_name', $project_name)->get()->paginate(21);

        //dd($pbas);

        $pbas_cas = \App\Pba::get()->groupBy('project_name');

        //프로젝트 수량 불러오기
        $pbas_counts =  \App\Pba::where('project_name', $project_name)->count();

        return view('pbas.list', compact('pbas', 'pbas_cas', 'pbas_counts'));
        //return $project_name;

       //dd(request());
       // dd($project_name);
        //return $pbas_ca->project_name;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pba  $pba
     * @return \Illuminate\Http\Response
     */
    public function view(Pba $pba)
    {
      $id = $pba->id;
      //dd($views); 
      $views =  \App\Pba::where('id', $id )->get();

      $users = \App\User::all();
      //dd($view); 
      return view('pbas.view', compact('views','users'));
    }

    public function edit(Pba $pba)
    {
        //dd($pba->id);

        #|--------------------------------------------------------------------------
        #| 보드명
        #|--------------------------------------------------------------------------
        $pcb_lists = \App\Boardname::get();

        #|--------------------------------------------------------------------------
        #| 프로젝트명
        #|--------------------------------------------------------------------------
        $project_lists = \App\Project::get();
        return view('pbas.edit',compact('pba', 'pcb_lists', 'project_lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pba  $pba
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pba $pba)
    {
        //dd(request()->all());

       $pba->update(request(['board_name', 'assy_name', 'project_name', 'content']));
 
        return redirect('/pbas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pba  $pba
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pba $pba)
    {
        //dd($pba);
                //dd(request());
        if(request('DELETE') == 'DELETE'){
            $pba->delete();
            flash('입력이 정상적으로 삭제되었습니다.');
        //echo "dd";
            return redirect('/pbas');
        }else{
            return back();    
        }
    }
}
