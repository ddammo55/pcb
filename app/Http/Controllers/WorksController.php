<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Works;
use App\Project;
use App\Boardname;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use Mail;

class WorksController extends Controller
{
    public function index()
    {

    	//$works = Works::latest()->paginate(10);
    	// $works = \DB::select("
    	// SELECT *, smt+dip+aoi+wave+cutting+touchup+coting+ass+packing+ready+ect1+ect2+wo+per AS total  FROM works
    	// ");

    	//$works =  DB::table('works')->select('*')->latest()->paginate(10);
        //모든 공정 공수를 합한다.
    	$works = DB::table('works')->select(DB::raw('*,(smt+dip+aoi+wave+touchup+coting+ass+packing+ready+ect1+ect2) as total'))->oldest('end_product_date')->paginate(15);

        //dd($works);

    	//$works = Works::latest()->paginate(10);
    	//$works = Works::select(DB::raw("SUM(smt+dip) as part"))->paginate(10);
    	// $works = DB::table('works')->select(DB::raw("SUM(smt+dip) as part"))->get();
    	//$works = DB::table('works')->count();
    	//컬럼합치기
    	//$sum = Works::latest()->value(DB::raw("SUM(smt+dip)")as ss)->get();
    	 //dd($works);
    	return view('works.index', compact('works'));
    }

    public function update(Works $work, Request $request)
    {
    	//dd(request()->all());
    	//$work->update($request->all());
    	$work->update([
            'board_name' => request('board_name'),
            'assy' => request('assy'),
            'ea' => request('ea'),
            'end_product_date' => request('end_product_date'),
            'status' => request('status'),
            //'wo' => request('wo'),
            'smt' => request('smt'),
            'dip' => request('dip'),
            'aoi' => request('aoi'),
            'wave' => request('wave'),
            // 'cutting' => request('cutting'),
            'touchup' => request('touchup'),
            'coting' => request('coting'),
            'ass' => request('ass'),
            'packing' => request('packing'),
            'ready' => request('ready'),
            'ect1' => request('ect1'),
            'ect2' => request('ect2'),
            'memo' => request('memo'),

        ]);
        Alert::success('저장', '저장이 완료 되었습니다.');
    	//return redirect()->back()->with('alert', '정상적으로 저장되었습니다.');
    	//flash('입력이 정상적으로 처리되었습니다.');
    	return back();
        //return redirect()->withSuccessMessage('dddd');

    }

    public function create()
    {
    	//프로젝트명 가져오기
    	$project_lists = \App\Project::get();

    	//보드명 가져오기
    	$board_names = \App\Boardname::all();


    	return view('works.create', compact('project_lists','board_names'));
    }

    //작업지시번호 생성
    public function store(Works $work, Request $request)
    {

        $rules = [
            'project_name' => ['required'],
            'ea' => ['required'],
        ];

        $messages = [
            'project_name.required' => '프로젝트는 필수 입력 항목 입니다.',
            'ea.required' => '수량은 필수 입력 항목 입니다.',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

         if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        //작업지시는 현재년,월,일 번호로 2019090001
        //dump(\Config::get('my_carbon.NOW_YMD'));  //"2019년 09월 01일"
        $Y = (\Config::get('my_carbon.NOW_Y')); //"2019"
        $M = (\Config::get('my_carbon.NOW_M')); //"09"
        $D = (\Config::get('my_carbon.NOW_D')); //"01"

        //날짜 201909
        $YMD = $Y.$M;

        //작업지시번호 최근꺼 가져오기
        $work = Works::latest()->pluck('work_no');

        //dd($work);

        //컬렉션이 비어있다면 false
        $workCheck = $work->isNotEmpty();


        if($workCheck != false){  //있다면...

                //dd($workCheck);

                //PBA201909001
                $finalWorkNumberNo = $work[0];

                //dd($finalWorkNumberNo);

                //데이터베이스 현제 년월 201909
                $DbYM = substr($finalWorkNumberNo,3,6);

                //dd($DbYM);

                 //데이터베이스 뒤에서 세자리만 가져온다 001
                $NumberNo = substr($finalWorkNumberNo,9,11);
                //$NumberNo =  sprintf('%03d',$NumberNo);
                //dd($NumberNo);


            if($YMD != $DbYM){ //현재년월과 데이터베이스년월이 다르면
                // 카운터 0001
                $count = sprintf('%03d',1);
            }else{
                $NumberNo = $NumberNo+1;
                //dd($NumberNo);
                $count = sprintf('%03d',$NumberNo);
            }

           //dd('있어');

        }else{ //없다면

            $YMD = $Y.$M;
            $count = sprintf('%03d',1);

        }

        // 접두
        $prefix = "PBA";

        //다만든 작업지시번호
        $completeWorkNo = $prefix.$YMD.$count;


        Works::create([
            'work_no' => $completeWorkNo,
            'title' => request('title'),
            'project_name' => request('project_name'),
            'project_code' => request('project_code'),
            'board_name' => request('board_name'),
            'assy' => request('assy'),
            'ea' => request('ea'),
            'set_set' => request('set_set'),
            'end_product_date' => request('end_product_date'),


        ]);
        Alert::success('작업 지시 완료', '작업 지시가 완료 되었습니다.');
    	return redirect('/works');
    }

    //공수입력에서 완료버튼을 눌렀을 때
    public function complate(Works $work, Request $request)
    {
        //dd(request()->all());
        //dd($work);
        $work->update([
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

        Alert::success('완료', '이메일 전송');
        //dd(event('이벤트 발생'));
        return back();
    }

    public function workform()
    {
        return view('works.index2');
    }
}
