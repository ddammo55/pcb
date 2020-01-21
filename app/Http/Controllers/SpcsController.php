<?php

namespace App\Http\Controllers;

use App\Exports\BoardsearchExport;
use App\Exports\BoardsearchExportView;
use Illuminate\Http\Request;
use App\Product;
use App\Project;
use App\Works;
use Maatwebsite\Excel\Facades\Excel;

class SpcsController extends Controller
{
    # 현재시간를 불러옴 : \Carbon\Carbon::now();

	# $val = '2015-10-11 11:22:33';
	# $dt = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $val);

    public function __construct()
    {
        //$fff = (\Config::get('my_carbon.FINAL_DAY'));

    }



    public function index()
    {
        //dd(\Config::get('my_carbon.NOW_S'));
        //(\Config::get('my_carbon.FINAL_DAY'));
        //dd($fff);
    	//현재년월일
    	$val = \Carbon\Carbon::now();
    	//dd($val);
    	//현재 년월일
    	//$nowDate = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $val);

        //현재 월의 마지막 날
        $myCarbonFinalDay = \Config::get('my_carbon.FINAL_DAY');

    	//현재 년월일
    	$hanNowDate = $val->format('Y년 m월 d일');

    	//현재 년
    	$nowYear = $val->format('Y');

    	//현재 월
    	$nowMonth = $val->format('m');

    	// 년 생산수량
        $year_count = \App\Product::where('product_date', '>=', $nowYear.'-01-01')->where('product_date', '<=' , $nowYear.'-12-31')->count();

        // 월 생산수량
        $month_count = \App\Product::where('product_date', '>=', $nowYear.'-'.$nowMonth.'-01')->where('product_date', '<=' , $nowYear.'-'.$nowMonth.'-'.$myCarbonFinalDay)->count();


        //현재까지 pba데이터 수량
        $productCount = \App\Product::where('quantity', 1)->count();

        //pba 한도견본 수량
        $pbaCount = \App\Pba::where('division' , 'PBA')->count();

        //assy 한도견본 수량
        $assyCount = \App\Pba::where('division' , 'ASSY')->count();

        //aoi 불량수량


        //aoi 부품수량


    	// 월별 통계적 관리 불러오기
    	$spc_month = \DB::select("

        SELECT
        ta.pro_month,
        ta.production,
        ta.aoi_part_num,
        ta.d1+ta.d2+ta.d3+ta.d4+ta.d5+ta.d6+ta.d7+ta.d8+ta.d9+ta.d10+ta.d11+ta.d12 AS df,
        (ta.ddd/ta.aoi_part_num)*1000000 AS ppm,
        ta.d1,ta.d2,ta.d3,ta.d4,ta.d5,ta.d6,ta.d7,ta.d8,ta.d9,ta.d10,ta.d11,ta.d12
        from (
        select
        MONTH(product_date)as pro_month,
        SUM(quantity) as Production,
        SUM(aoi_top_part_num+aoi_bot_part_num) AS aoi_part_num,

        SUM(aoi_top_df_01+aoi_bot_df_01+aoi_top_df_02+aoi_bot_df_02+aoi_top_df_03+aoi_bot_df_03+aoi_top_df_04+aoi_bot_df_04+aoi_top_df_05+aoi_bot_df_05+
        aoi_top_df_06+aoi_bot_df_06+aoi_top_df_07+aoi_bot_df_07+aoi_top_df_08+aoi_bot_df_08+aoi_top_df_09+aoi_bot_df_09+aoi_top_df_10+aoi_bot_df_10+aoi_top_df_11+aoi_bot_df_11+aoi_top_df_12+aoi_bot_df_12) AS ddd,

        SUM(aoi_top_df_01+aoi_bot_df_01) as d1,
        SUM(aoi_top_df_02+aoi_bot_df_02) as d2,
        SUM(aoi_top_df_03+aoi_bot_df_03) as d3,
        SUM(aoi_top_df_04+aoi_bot_df_04) as d4,
        SUM(aoi_top_df_05+aoi_bot_df_05) as d5,
        SUM(aoi_top_df_06+aoi_bot_df_06) as d6,
        SUM(aoi_top_df_07+aoi_bot_df_07) as d7,
        SUM(aoi_top_df_08+aoi_bot_df_08) as d8,
        SUM(aoi_top_df_09+aoi_bot_df_09) as d9,
        SUM(aoi_top_df_10+aoi_bot_df_10) as d10,
        SUM(aoi_top_df_11+aoi_bot_df_11) as d11,
        SUM(aoi_top_df_12+aoi_bot_df_12) as d12
        FROM products WHERE product_date>= '$nowYear-01-01' and product_date<= '$nowYear-12-31'
        group by MONTH(product_date)) ta
        ");

        // 년별 통계적 관리 불러오기
    	$spc_year = \DB::select("

        SELECT
        ta.pro_month,
        ta.production,
        ta.aoi_part_num,
        ta.d1+ta.d2+ta.d3+ta.d4+ta.d5+ta.d6+ta.d7+ta.d8+ta.d9+ta.d10+ta.d11+ta.d12 AS df,
        (ta.ddd/ta.aoi_part_num)*1000000 AS ppm,
        ta.d1,ta.d2,ta.d3,ta.d4,ta.d5,ta.d6,ta.d7,ta.d8,ta.d9,ta.d10,ta.d11,ta.d12
        from (
        select
        YEAR(product_date)as pro_month,
        SUM(quantity) as Production,
        SUM(aoi_top_part_num+aoi_bot_part_num) AS aoi_part_num,

        SUM(aoi_top_df_01+aoi_bot_df_01+aoi_top_df_02+aoi_bot_df_02+aoi_top_df_03+aoi_bot_df_03+aoi_top_df_04+aoi_bot_df_04+aoi_top_df_05+aoi_bot_df_05+
        aoi_top_df_06+aoi_bot_df_06+aoi_top_df_07+aoi_bot_df_07+aoi_top_df_08+aoi_bot_df_08+aoi_top_df_09+aoi_bot_df_09+aoi_top_df_10+aoi_bot_df_10+aoi_top_df_11+aoi_bot_df_11+aoi_top_df_12+aoi_bot_df_12) AS ddd,

        SUM(aoi_top_df_01+aoi_bot_df_01) as d1,
        SUM(aoi_top_df_02+aoi_bot_df_02) as d2,
        SUM(aoi_top_df_03+aoi_bot_df_03) as d3,
        SUM(aoi_top_df_04+aoi_bot_df_04) as d4,
        SUM(aoi_top_df_05+aoi_bot_df_05) as d5,
        SUM(aoi_top_df_06+aoi_bot_df_06) as d6,
        SUM(aoi_top_df_07+aoi_bot_df_07) as d7,
        SUM(aoi_top_df_08+aoi_bot_df_08) as d8,
        SUM(aoi_top_df_09+aoi_bot_df_09) as d9,
        SUM(aoi_top_df_10+aoi_bot_df_10) as d10,
        SUM(aoi_top_df_11+aoi_bot_df_11) as d11,
        SUM(aoi_top_df_12+aoi_bot_df_12) as d12
        FROM products WHERE product_date>= '$nowYear-01-01' and product_date<= '$nowYear-12-31'
        group by YEAR(product_date)) ta
        ");

        $month_ppm = \DB::select("

        SELECT

        (ta.ddd/ta.aoi_part_num)*1000000 AS ppm

        from (
        select

        SUM(aoi_top_part_num+aoi_bot_part_num) AS aoi_part_num,

        SUM(aoi_top_df_01+aoi_bot_df_01+aoi_top_df_02+aoi_bot_df_02+aoi_top_df_03+aoi_bot_df_03+aoi_top_df_04+aoi_bot_df_04+aoi_top_df_05+aoi_bot_df_05+
        aoi_top_df_06+aoi_bot_df_06+aoi_top_df_07+aoi_bot_df_07+aoi_top_df_08+aoi_bot_df_08+aoi_top_df_09+aoi_bot_df_09+aoi_top_df_10+aoi_bot_df_10+aoi_top_df_11+aoi_bot_df_11+aoi_top_df_12+aoi_bot_df_12) AS ddd

        FROM products WHERE product_date>= '$nowYear-$nowMonth-01' and product_date<= '$nowYear-$nowMonth-$myCarbonFinalDay'
        group by MONTH(product_date)) ta
        ");



        //월별 공수 쿼리
        $month_works = \DB::select("
            SELECT
            SUM(smt) AS smt,
            SUM(dip) AS dip,
            SUM(aoi) AS aoi,
            SUM(wave) AS wave,
            #SUM(cutting) AS cutting,
            SUM(touchup) AS touchup,
            SUM(coting) AS coting,
            SUM(ass) AS ass,
            SUM(packing) AS packing,
            SUM(ready) AS ready,
            SUM(ect1) AS ect1,
            SUM(ect2) AS ect2
            FROM works where created_at>='$nowYear-$nowMonth-01' and created_at<='$nowYear-$nowMonth-$myCarbonFinalDay'
            ");


// 생산수량 어레이-------------------

// 타입은 array $spc_month
//dd($month_works);
$result_array = array(); //$result_array = array배열();    배열공란을 만들어준다.

foreach ($spc_month as $mon) {
    array_push($result_array,$mon->production);
}

$join_arr1=join("|",$result_array);   // 2414|1250|2648|633|2085|1247|828


// 공수 어레이-------------------
$result_array_works = array(); //배열공란을 만들어준다.

foreach ($month_works as $month_work) {
    array_push($result_array_works,
        $month_work->smt,
        $month_work->dip,
        $month_work->aoi,
        $month_work->wave,
        #$month_work->cutting,
        $month_work->touchup,
        $month_work->coting,
        $month_work->ass,
        $month_work->packing,
        $month_work->ready,
        $month_work->ect1,
        $month_work->ect2);
}

$join_arr_work=join(",",$result_array_works);
//dd($join_arr_work);

// 월별 공수 합계-------------------
$month_work_sum = \DB::select("
    SELECT
    SUM(smt+dip+wave+aoi+cutting+touchup+coting+ass+packing+ready+ect1+ect2) AS total
    FROM works where created_at>='$nowYear-$nowMonth-01' and created_at<='$nowYear-$nowMonth-$myCarbonFinalDay'
    ");
$month_work_sum = $month_work_sum;
$month_work_sum = ($month_work_sum[0]);

// 월 어레이------------------------
$result_array_month = array(); //$result_array = array배열();    배열공란을 만들어준다.

foreach ($spc_month as $mon) {
    array_push($result_array_month,$mon->pro_month);
}

$join_arr2=join("|",$result_array_month);   // 1|2|3|4|5|6|7

//var_dump($join_arr2);

// ----------------------------



return view('main.main2', compact('year_count', 'month_count', 'nowYear', 'nowMonth', 'hanNowDate', 'spc_month', 'spc_year' , 'productCount', 'pbaCount', 'assyCount','join_arr1', 'join_arr2', 'month_ppm', 'join_arr_work', 'month_work_sum'));
    }

    public function monthProductList()
    {
        $choice = (request('month'));
        //현재년월일
        $val = \Carbon\Carbon::now();
        //dd($val);
        //현재 년월일
        //$nowDate = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $val);

        //현재 2019년08월08일
        $hanNowDate = $val->format('Y년 m월 d일');

        //현재 2019년
        $nowYear = $val->format('Y');
        //dd($nowYear);

        //현재 08월
        $nowMonth = $val->format('m');
        //dd($nowMonth);
         //$month_products = \App\Product::where('product_date', '>', $nowYear.'-'.$nowMonth.'-01')->where('product_date', '<' , $nowYear.'-'.$nowMonth.'-31')->get();

        //현재 월의 마지막 날
        $myCarbonFinalDay = \Config::get('my_carbon.FINAL_DAY');
        //$FINAL_DAY = date("t", mktime(0, 0, 0,  $nowMonth, 1,  $nowYear));
        //dd($myCarbonFinalDay );

        //dd($FINAL_DAY);


        //2월이면
        if($choice == 2){

           $month_products = \DB::select("

               SELECT board_name, SUM(quantity) as sum, product_date FROM products where product_date>='$nowYear-$choice-01' and product_date<='$nowYear-$choice-28' group by board_name,product_date having board_name is not null and board_name <>'' order by product_date DESC
               ");

           $month_products_sum = \DB::select("
               SELECT SUM(quantity) as products_sum FROM products WHERE product_date>='$nowYear-$choice-01' AND product_date<='$nowYear-$choice-28'
               ");

         //보드 종류
           $month_count = count($month_products);

//dd($month_products);
        }else{



        if(isset($choice)){

         $month_products = \DB::select("

         SELECT board_name, SUM(quantity) as sum, product_date FROM products where product_date>='$nowYear-$choice-01' and product_date<='$nowYear-$choice-$myCarbonFinalDay' group by board_name,product_date having board_name is not null and board_name <>'' order by product_date DESC
         ");

         $month_products_sum = \DB::select("
         SELECT SUM(quantity) as products_sum FROM products WHERE product_date>='$nowYear-$choice-01' AND product_date<='$nowYear-$choice-$myCarbonFinalDay'
         ");

         //보드 종류
         $month_count = count($month_products);



        }else{

         $month_products = \DB::select("

         SELECT board_name, SUM(quantity) as sum, product_date FROM products where product_date>='$nowYear-$nowMonth-01' and product_date<='$nowYear-$nowMonth-$myCarbonFinalDay' group by board_name,product_date having board_name is not null and board_name <>'' order by product_date DESC
         ");

         $month_products_sum = \DB::select("
         SELECT SUM(quantity) as products_sum FROM products WHERE product_date>='$nowYear-$nowMonth-01' AND product_date<='$nowYear-$nowMonth-$myCarbonFinalDay'
         ");

         //보드 종류
         $month_count = count($month_products);
        }

        //dd($month_products_sum);

       }


         //dd($month_products);

        return view('main.month_product_list', compact('month_products', 'nowMonth', 'choice', 'month_count', 'month_products_sum'));
    }


    public function monthProductListSel(){
        $board_name = request('board_name');
        $product_date = request('product_date');

       $results = \App\Product::where('board_name',$board_name)->where('product_date', '>=', $product_date)->where('product_date', '<=', $product_date)->orderBy('board_name','desc')->get();

       //보드수량
       $results_count = count($results);
       //dd($results);

        return view('main.month_product_list_board',compact('board_name','product_date', 'results', 'results_count'));
    }


    //보드내역별 검색
    public function boardSearchList(Request $request)
    {
       $NOW_YMD = (\Config::get('my_carbon.NOW_YMD'));
       $NOW_Y = (\Config::get('my_carbon.NOW_Y'));
       $NOW_M = (\Config::get('my_carbon.NOW_M'));
       $NOW_D = (\Config::get('my_carbon.NOW_D'));
       $D1 = '01';
        //현재 월의 마지막 날
       $myCarbonFinalDay = \Config::get('my_carbon.FINAL_DAY');


        //선택된 보드명
        $board_name_search = request('board_name_choice');

        //선택된 시작날짜
        $start_date = request('start_date',$NOW_Y.'-'.$NOW_M.'-'.$D1);

        //선택된 마지막날짜
        $end_date = request('end_date',$NOW_Y.'-'.$NOW_M.'-'.$myCarbonFinalDay);

        //보드명 가져오기
        $board_names = \App\Boardname::all();

        //조건으로 pba 가져오기
       // $products = \App\Product::latest()->paginate(30);

         $products = \App\Product::where('board_name', $board_name_search)->where('product_date', '>=', $start_date)->where('product_date', '<=', $end_date)->latest()->get();

         $products_count = count($products);

         //dd($products_count);

        return view('main.board_search_list', compact('board_names', 'board_name_search','start_date', 'end_date', 'products', 'products_count'));
    }

    //출하내역 검색 리스트
    public function shipmentSearchList(Request $request)
    {

        $NOW_YMD = (\Config::get('my_carbon.NOW_YMD'));
        $NOW_Y = (\Config::get('my_carbon.NOW_Y'));
        $NOW_M = (\Config::get('my_carbon.NOW_M'));
        $NOW_D = (\Config::get('my_carbon.NOW_D'));
        $D1 = '01';
        //현재 월의 마지막 날
        $myCarbonFinalDay = \Config::get('my_carbon.FINAL_DAY');

        //선택된 출하내역
        $shipment_name_choice = request('shipment_name_choice');

        //선택된 시작날짜
        $start_date = request('start_date',$NOW_Y.'-'.$NOW_M.'-'.$D1);

        //선택된 마지막날짜
        $end_date = request('end_date',$NOW_Y.'-'.$NOW_M.'-'.$myCarbonFinalDay);

        //프로젝트 가져오기
        $projects = \App\Project::all();

        //조건으로 pba 가져오기
       // $products = \App\Product::latest()->paginate(30);

         $products = \App\Product::where('shipment_daily', $shipment_name_choice)->where('product_date', '>=', $start_date)->where('product_date', '<=', $end_date)->latest()->get();

         $products_count = count($products);

        return view('main.shipment_search_list', compact('projects', 'shipment_name_choice','start_date', 'end_date', 'products','products_count'));
    }

    //excel
    public function export()
    {
        return Excel::download(new BoardsearchExport(), 'qwer.xlsx');
    }

    //블레이드
    public function export_view()
    {
        return Excel::download(new BoardsearchExportView(), 'view.xlsx');
    }


}
