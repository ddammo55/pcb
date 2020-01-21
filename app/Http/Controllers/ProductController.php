<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{

    public function index()
    {
        $products = \App\Product::latest()->paginate(15); 

       return view('product.index',compact('products'));
    }


    public function product_create()
    {
        //[NEW시리얼번호구현]
        //시리얼 번호 최근 컬럼을 가지고 온다.
        $products_first = \App\Product::latest('id')->first('serial_name');

        //보드명이 널이거나 수량이 없으면 또는 200장이 초과하면
        if(request('board_name') == null || request('quantity') == 0 || request('quantity') == 201){
             echo "<script>alert(\"보드명과 수량을 확인하여주세요.\");</script>";
             echo "<script> history.back()</script>";
        }else{

        //보드명
        $board_name = request()->board_name;

        echo '<br>';
        //수량
        $quantity = request()->quantity;
        
        //19F
        $serial_year_month=substr($products_first->serial_name,0,3);


        //월 조건문
        if(date('m') == 1){
            $month = 'A';
        }else if(date('m') == 2){
            $month = 'B';
        }else if(date('m') == 3){
            $month = 'C';
        }else if(date('m') == 4){
            $month = 'D';
        }else if(date('m') == 5){
            $month = 'E';
        }else if(date('m') == 6){
            $month = 'F';        
        }else if(date('m') == 7){
            $month = 'G';        
        }else if(date('m') == 8){
            $month = 'H';        
        }else if(date('m') == 9){
            $month = 'I';        
        }else if(date('m') == 10){
            $month = 'J';        
        }else if(date('m') == 11){
            $month = 'K';        
        }else if(date('m') == 12){
            $month = 'L';        
        }
        
        $year = date('y');
        $yearMonth = $year.$month;
        //dd($serial_year_month);
        // 만약에 해당월이 없으면 19F 가 있으면 번호를 이으고 없으면 0000으로 시작 
        if($serial_year_month == $yearMonth){
            //숫자만 남긴다. 0005
             $serial_start_no_int=substr($products_first->serial_name,3,4);
             //숫자 남긴거 +1
             $ttr = sprintf("%04d",$serial_start_no_int+1);
        }else{
             //$serial_start_no_int=substr($products_first->serial_name,3,4);
             $serial_start_no_int=0000; 

             //숫자 남긴거 +1  
             $ttr = sprintf("%04d",$serial_start_no_int+1);

        }
        //dd($ttr);
        //dd($ttr);
        //앞에만 남긴다. 19A   [19]
        $serial_start_no_start= date('y'); //해당년도 뒤에 두자리만 2019 = 19
        //[2019.06.15]$serial_start_no_start=substr($products_first->serial_name,0,2);



        //19F 완성
        $serial_start_no_start = $serial_start_no_start .$month;
        //dd($serial_start_no_start);
        // $month = 'F';

        // $serial_start_no_start = sprintf("%04d",$serial_start_no_start);

        // dd($serial_start_no_start);

        //***[완성]*** 11a0011
        $serial_start_no = $serial_start_no_start.$ttr;
        //dd($serial_start_no);

        //현재숫자와 보드작업수량을 합친다. 53 + 50
        $sum_serial_number = sprintf("%04d",$serial_start_no_int) + sprintf("%04d",$quantity);
        //dd($sum_serial_number);

        //0053
        $eee = sprintf("%04d",$sum_serial_number);
        //dd($eee);
        //***[완성]*** 11a0060
        $serial_end_no = $serial_start_no_start.$eee;
        //dd($serial_end_no);
        // 초기값
       $y=0;
       $i=0;

        for($i=$ttr;$i<=$eee;$i++){
        $y+=1;
        $i=(int)$i;
        $serial_name=$serial_start_no_start.sprintf("%04d",$i);

        //대문자변환
        $serial_name=strtoupper($serial_name);


        $serial_name_arr[] = $serial_name;

        //echo $tty = $serial_name_arr;

        Product::create([
            'serial_name' => $serial_name,
            'board_name' => request('board_name'),
            'product_date' => NOW(),
            'aoi_top_part_num' => request('aoi_top_part_num'),
            'aoi_bot_part_num' => request('aoi_bot_part_num'),
            'user_id' => auth()->user()->name, //입력한 사용자
        ]);
       
    }
        return view('product.create_list',compact('serial_name_arr'));
}
    }

    public function create()
    {   
        //전체 시리얼번호 [최근시리얼번호 조회]
        $products = \App\Product::latest('id')->paginate(30); 

        //시리얼 번호 최근 컬럼을 가지고 온다.
        $products_first = \App\Product::latest('id')->first('serial_name');
        
        //dd($products_first);
        //만약 시리얼 번호가 없으면..
        if($products_first == null){
            $products_first = '11A0001';
        //숫자만 남긴다. 0005
        $serial_start_no_int=substr($products_first,3,4);
        //앞에만 남긴다. 19A
        $serial_start_no_start=substr($products_first,0,3);
        }else{
        //숫자만 남긴다. 0005
        $serial_start_no_int=substr($products_first->serial_name,3,4);
        
        //앞에만 남긴다. 19A
        $serial_start_no_start=substr($products_first->serial_name,0,3);

        }
        //숫자1을 더한다. 0006
        $ttr = sprintf("%04d",$serial_start_no_int+1);


        //다시 영문과 숫자를 합친다.
        $final_serial_name = $serial_start_no_start.$ttr;

        //마지막 시리얼번호 + 0001 한 결과변수
        $final_serial_name;

        #|--------------------------------------------------------------------------
        #| 보드명
        #|--------------------------------------------------------------------------
        $pcb_lists = \App\Boardname::get();

        //dd($board);

        //$board_name = $board->board_name;

        //echo $board->board_name;


        return view('product.create',compact('products','final_serial_name','pcb_lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //[구형 시리얼번호]
        //시리얼 번호 받기   
       $serial_start_no=$request['serial_start_no'];
       $serial_end_no=$request['serial_end_no'];

        //시리얼번호 숫자만 남긴다 19A0001 => 0001
       $serial_start_no_int=substr($serial_start_no,3,4);
       $serial_end_no_int=substr($serial_end_no,3,4);

        // 초기값
       $y=0;
       $i=0;

        //시리얼번호 영문만 담는 변수 19A0001 => 19A 
       $serial_english_name=substr($serial_start_no,0,3);

        // 반복문 
       for($i=$serial_start_no_int;$i<=$serial_end_no_int;$i++)
       {
        // $i="0001";
        
        $y+=1;
        $i=(int)$i;
        $serial_name=$serial_english_name.sprintf("%04d",$i);

        //대문자변환
        $serial_name=strtoupper($serial_name);
        //$serial_name="19A0001";

        //셀번호 배열에 담기
        $serial_name_arr[] = $serial_name;
        }   

        $cc = count($serial_name_arr);
        if($cc > 200)
        {
         


         echo "<script>alert(\"200장 초과제한입니다. 관리자에게 문의해 주세요.\");</script>";
         echo "<script> history.back()</script>";
         //return back();

        }else{
        for($i=$serial_start_no_int;$i<=$serial_end_no_int;$i++){
        $y+=1;
        $i=(int)$i;
        $serial_name=$serial_english_name.sprintf("%04d",$i);

        //대문자변환
        $serial_name=strtoupper($serial_name);

        // $serial_name 와 기존 old_serial_name가 같은면 에러 발생
        $old_serial_name = DB::table('products')->where('serial_name', $serial_name)->value('serial_name');
        //$old_serial_name = \App\Product::find($serial_name)->serial_name;

        // dd($sese);
        // return false;

        if($serial_name == $old_serial_name){
            echo "<script>alert(\"$serial_name 시리얼번호가 중복입니다.\");</script>";
         echo "<script> history.back()</script>";
        }else{


        Product::create([
            'serial_name' => $serial_name,
            'board_name' => request('board_name'),
            'product_date' => NOW(),
            'aoi_top_part_num' => request('aoi_top_part_num'),
            'aoi_bot_part_num' => request('aoi_bot_part_num'),
            'user_id' => auth()->user()->name, //입력한 사용자

        ]);
        }
    }
}
       return view('product.create_list',compact('serial_name_arr'));
}

public function show(Product $product)
{
        //
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $projects_names = \App\Project::all(); // 프로젝트 명 
       return view('shipment.edit', compact('product','projects_names'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //dd($product);
       $product->update([
        'shipment_daily' => request('shipment_daily'),
        'shipment' => request('shipment'),
        'set_set' => request('set_set'),
        'faulty' => request('faulty'),
        'type' => request('type'),
        'receiver_team' => request('receiver_team'),
        'receiver' => request('receiver'),
        'coting_t' => request('coting_t'),
        'coting_inp' => request('coting_inp'),
        'note' => request('note'),
        'aoi_top_df_01' => request('aoi_top_df_01'),
        'aoi_top_df_02' => request('aoi_top_df_02'),
        'aoi_top_df_03' => request('aoi_top_df_03'),
        'aoi_top_df_04' => request('aoi_top_df_04'),
        'aoi_top_df_05' => request('aoi_top_df_05'),
        'aoi_top_df_06' => request('aoi_top_df_06'),
        'aoi_top_df_07' => request('aoi_top_df_07'),
        'aoi_top_df_08' => request('aoi_top_df_08'),
        'aoi_top_df_09' => request('aoi_top_df_09'),
        'aoi_top_df_10' => request('aoi_top_df_10'),
        'aoi_top_df_11' => request('aoi_top_df_11'),
        'aoi_top_df_12' => request('aoi_top_df_12'),

        'aoi_bot_df_01' => request('aoi_bot_df_01'),
        'aoi_bot_df_02' => request('aoi_bot_df_02'),
        'aoi_bot_df_03' => request('aoi_bot_df_03'),
        'aoi_bot_df_04' => request('aoi_bot_df_04'),
        'aoi_bot_df_05' => request('aoi_bot_df_05'),
        'aoi_bot_df_06' => request('aoi_bot_df_06'),
        'aoi_bot_df_07' => request('aoi_bot_df_07'),
        'aoi_bot_df_08' => request('aoi_bot_df_08'),
        'aoi_bot_df_09' => request('aoi_bot_df_09'),
        'aoi_bot_df_10' => request('aoi_bot_df_10'),
        'aoi_bot_df_11' => request('aoi_bot_df_11'),
        'aoi_bot_df_12' => request('aoi_bot_df_12'),
     
       ]);
       flash('입력이 정상적으로 처리되었습니다.');
       //return back();
        return redirect('/shipment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
