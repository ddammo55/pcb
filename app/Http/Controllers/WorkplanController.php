<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workplan;
use App\Worktask;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class WorkplanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( $work_search = request('work_search')){
            $work_search = request('work_search');
            //$works = DB::table('workplans')->where('project_name','like' , '%'.$work_search.'%' )->select(DB::raw('*,(smt+dip+aoi+wave+touchup+item_inspection+coting+ass+packing+ready+ect1+ect2) as total'))->orderBy('created_at','DESC')->paginate(13);
            $works = DB::table('workplans')
            ->leftJoin('worktasks', 'workplans.id', '=', 'worktasks.workplan_id')
            ->where('project_name','like' , '%'.$work_search.'%' )
            ->selectRaw('workplans.*, sum(worktasks.wt) as wtsum')
            ->groupBy('workplans.id')
            ->latest()
            ->paginate(10);
        }else{
        //$pbas = \App\Pba::where('board_name', 'like' , '%'.$board_name.'%')->paginate(50);

       // $workplans = \App\Workplan::latest()->paginate(15);
        //$workSum = DB::table('workplans')->select(DB::raw('*,(smt+dip+aoi+wave+touchup+item_inspection+coting+ass+packing+ready+ect1+ect2) as total'))->get();


        //$works = DB::table('workplans')->select(DB::raw('*,(smt+dip+aoi+wave+touchup+item_inspection+coting+ass+packing+ready+ect1+ect2) as total'))->orderBy('created_at','DESC')->paginate(13);
        //$works = Workplan::orderBy('created_at','DESC')->paginate(13);
            //dd($works[0]->id);
            $works = DB::table('workplans')
            ->leftJoin('worktasks', 'workplans.id', '=', 'worktasks.workplan_id')
            ->selectRaw('workplans.*, sum(worktasks.wt) as wtsum')
            ->groupBy('workplans.id')
            ->latest()
            ->paginate(10);

            //dd($works);
        //dd($articles->first()->work_no);

       //부모속성가져오기
       //dd($comment->workplan->title);
        //dd($str2);

        }
        // $smt = $works[0]->smt;
        // $dip = $works[0]->dip;
        // $aoi = $works[0]->aoi;
        // $touchup = $works[0]->touchup;
        // $item_inspection = $works[0]->item_inspection;
        // $coting = $works[0]->coting;
        // $ass = $works[0]->ass;

        // if($smt == !null){
        //     $smt = 1;
        // }else{
        //     $smt = 0;
        // }

       // dd($smt);

        //dd($smt.','.$dip.','.$aoi.','.$touchup.','.$item_inspection.','.$coting.','.$ass);

        return view('workplan.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //프로젝트명 가져오기
        $project_lists = \App\Project::get();

        //보드명 가져오기
        $board_names = \App\Boardname::all();


        return view('workplan.create', compact('project_lists', 'board_names'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Workplan $workplan,Request $request)
    {
        //dd(request()->all());

        $rules = [
            'title' => 'required',
            'project_name' => ['required'],
            'ea' => ['required'],
        ];

        $messages = [
            'title.required' => '제목은 필수 입력 항목 입니다.',
            'project_name.required' => '프로젝트는 필수 입력 항목 입니다.',
            'ea.required' => '수량은 필수 입력 항목 입니다.',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //작업지시는 현재년,월,일 번호로 2019090001
        //dump(\Config::get('my_carbon.NOW_YMD'));  //"2019년 09월 01일"
        $Y = (\Config::get('my_carbon.NOW_Y')); //"2019"
        $M = (\Config::get('my_carbon.NOW_M')); //"09"
        $D = (\Config::get('my_carbon.NOW_D')); //"01"

        //날짜 201909
        $YMD = $Y . $M;

        //작업지시번호 최근꺼 가져오기
        $workplan = Workplan::latest()->pluck('work_no');

        //dd($work);

        //컬렉션이 비어있다면 false
        $workCheck = $workplan->isNotEmpty();


        if ($workCheck != false) {  //있다면...

            //dd($workCheck);

            //PBA201909001
            $finalWorkNumberNo = $workplan[0];

            //dd($finalWorkNumberNo);

            //데이터베이스 현제 년월 201909
            $DbYM = substr($finalWorkNumberNo, 3, 6);

            //dd($DbYM);

            //데이터베이스 뒤에서 세자리만 가져온다 001
            $NumberNo = substr($finalWorkNumberNo, 9, 11);
            //$NumberNo =  sprintf('%03d',$NumberNo);
            //dd($NumberNo);


            if ($YMD != $DbYM) { //현재년월과 데이터베이스년월이 다르면
                // 카운터 0001
                $count = sprintf('%03d', 1);
            } else {
                $NumberNo = $NumberNo + 1;
                //dd($NumberNo);
                $count = sprintf('%03d', $NumberNo);
            }

            //dd('있어');

        } else { //없다면

            $YMD = $Y . $M;
            $count = sprintf('%03d', 1);
        }

        // 접두
        $prefix = "PBA";

        //다만든 작업지시번호
        $completeWorkNo = $prefix . $YMD . $count;


        Workplan::create([
            'work_no' => $completeWorkNo,
            'title' => request('title'),
            'project_name' => request('project_name'),
            'project_code' => request('project_code'),
            'board_name' => request('board_name'),
            'assy' => request('assy'),
            'ea' => request('ea'),
            'set_set' => request('set_set'),
            'start_product_date' => request('start_product_date'),
            'end_product_date' => request('end_product_date'),
            'memo' => request('memo'),
            'ass' => 0,
            'con' => request('con'),
            'wr_user' => auth()->user()->name, //입력한 사용자

        ]);
        Alert::success('작업 지시 완료', '작업 지시가 완료 되었습니다.');
        return redirect('/workplan');
    }


     //공수입력에서 완료버튼을 눌렀을 때
     public function complate($id, Request $request)
     {
         //dd($id);
         $workplan = Workplan::find($id);
        // dd(request()->all());
        //dd(request('con'));
        //dd($workplan);
        $workplan->update([
             'con' => request('con'),
         ]);

         //dd(request()->all());

         // Mail::send(
         //     'emails.articles.created',
         //     compact('works.index'),

         //     function ($message) use ($work){
         //         $message->form('ddammo55@naver.com','Your Name');
         //         $message->to(['ddammo55@naver.com','your3@domain']);
         //         $message->subject('새글이 등록 되었습니다.');
         //         $message->cc('yours4@domain');
         //         $message->attach(storage_path('elephant.png'));
         //     }

         // );
         if($workplan->con == 0){
            Alert::warning('취소', '');
         }else{
            Alert::success('완료', '');
         }

         //Alert::success('완료', '.');
         //dd(event('이벤트 발생'));
         return back();
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workplan  $workplan
     * @return \Illuminate\Http\Response
     */
    public function show(Workplan $workplan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workplan  $workplan
     * @return \Illuminate\Http\Response
     */
    public function edit(Workplan $workplan)
    {
       $id = $workplan->id;
       // dd($id);
       $workSum = DB::table('workplans')->select(DB::raw('*,(smt+dip+aoi+wave+touchup+item_inspection+coting+ass+packing+ready+ect1+ect2) as total'))->whereId($id)->get();

       $workSum = ($workSum[0]->total);

       //댓글공수를 sum한다.
       //$workSum = DB::table('workplans')->select(DB::raw('*,(smt+dip+aoi+wave+touchup+item_inspection+coting+ass+packing+ready+ect1+ect2) as total'))->whereId($id)->get();

       //dd($workSum);
       $worktasks = \App\Workplan::find($id)->worktasks()->get();
       //dd($worktasks);
       $worktasksSum = \App\Worktask::where('workplan_id' , $id)->sum('wt');
       //$worktasks = \App\Workplan::find($id)->worktasks()->get();
       //dd(count($worktasks->wt));

       return view('workplan.edit', compact('workplan','workSum','worktasks','worktasksSum'));
    }



    public function admin_edit(Workplan $workplan)
    {
        //dd($workplan);
        $id = $workplan->id;

       $workSum = DB::table('workplans')->select(DB::raw('*,(smt+dip+aoi+wave+touchup+item_inspection+coting+ass+packing+ready+ect1+ect2) as total'))->whereId($id)->get();

       $workSum = ($workSum[0]->total);

        //프로젝트명 가져오기
        $project_lists = \App\Project::get();

        //보드명 가져오기
        $board_names = \App\Boardname::all();

        //공수값합계
        //$worktasks = \App\Workplan::find($id)->worktasks()->get();

        //dd($worktasks);

        return view('workplan.admin_edit', compact('workplan','workSum','project_lists','board_names'));
    }

    public function admin_update(Workplan $workplan)
    {
        //dd(request()->all());
        $workplan->update([
            'title' => request('title'),
            'project_name' => request('project_name'),
            'board_name' => request('board_name'),
            'assy' => request('assy'),
            'ea' => request('ea'),
            'set_set' => request('set_set'),
            'start_product_date' => request('start_product_date'),
            'end_product_date' => request('end_product_date'),
            'memo' => request('memo')

        ]);

        Alert::success('저장', '수정이 완료 되었습니다.');
        return redirect('workplan');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workplan  $workplan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workplan $workplan)
    {
        // dd(request()->all());
        if(request('ect2') == null){
            $ect2 = 0;
        }else{
            $ect2 = request('ect2');
        }

        $workplan->update([
            'smt' => request('smt'),
            'dip' => request('dip'),
            'aoi' => request('aoi'),
            'wave' => request('wave'),
            'touchup' => request('touchup'),
            'coting' => request('coting'),
            'ass' => request('ass'),
            'item_inspection' => request('item_inspection'),
            'packing' => request('packing'),
            'ready' => request('ready'),
            'ect1' => request('ect1'),
            'ect2' => $ect2,

        ]);

        Alert::success('저장', '저장이 완료 되었습니다.');
        return redirect('workplan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workplan  $workplan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workplan $workplan)
    {
        //
    }
}
