<?php

namespace App\Http\Controllers;

use App\Exports\BoardsearchExport;
use App\Exports\ShipmentSearchExport;
use Illuminate\Http\Request;
use App\Product;
use App\Project;
use App\Works;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class SpcsController extends Controller
{
    # 현재시간를 불러옴 : \Carbon\Carbon::now();

    # $val = '2015-10-11 11:22:33';
    # $dt = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $val);

    public function __construct()
    {
        //$fff = (\Config::get('my_carbon.FINAL_DAY'));

    }

    //현재년도 -1 이전 년도
    public function yearSpc()
    {
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
        $year_count = \App\Product::where('product_date', '>=', $nowYear . '-01-01')->where('product_date', '<=', $nowYear . '-12-31')->count();

        // 월 생산수량
        $month_count = \App\Product::where('product_date', '>=', $nowYear . '-' . $nowMonth . '-01')->where('product_date', '<=', $nowYear . '-' . $nowMonth . '-' . $myCarbonFinalDay)->count();


        //현재까지 pba데이터 수량
        $productCount = \App\Product::where('quantity', 1)->count();

        //pba 한도견본 수량
        $pbaCount = \App\Pba::where('division', 'PBA')->count();

        //assy 한도견본 수량
        $assyCount = \App\Pba::where('division', 'ASSY')->count();

        //aoi 불량수량


        //aoi 부품수량

        //dd();
        // 월별 통계적 관리 불러오기
        $yearSelect = request('year_select');



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
               FROM products WHERE product_date>= '$yearSelect-01-01' and product_date<= '$yearSelect-12-31'
               group by MONTH(product_date)) ta
               ");



        // 년 생산수량
        $year_count = \App\Product::where('product_date', '>=', $yearSelect . '-01-01')->where('product_date', '<=', $yearSelect . '-12-31')->count();

        // 타입은 array $spc_month
        //dd($month_works);
        $result_array = array(); //$result_array = array배열();    배열공란을 만들어준다.

        foreach ($spc_month as $mon) {
            array_push($result_array, $mon->production);
        }

        $join_arr1 = join("|", $result_array);   // 2414|1250|2648|633|2085|1247|828


                // 월 어레이------------------------
                $result_array_month = array(); //$result_array = array배열();    배열공란을 만들어준다.

                foreach ($spc_month as $mon) {
                    array_push($result_array_month, $mon->pro_month);
                }

                $join_arr2 = join("|", $result_array_month);   // 1|2|3|4|5|6|7

                //dd($join_arr2);



                // ----------------------------

                //dd($join_arr1.$join_arr2);

        return view('main.mainYearSelect', compact('join_arr1','join_arr2','yearSelect','year_count'));
    }



    public function index()
    {

        // dd("index");
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
        $year_count = \App\Product::where('product_date', '>=', $nowYear . '-01-01')->where('product_date', '<=', $nowYear . '-12-31')->count();

        // 월 생산수량
        $month_count = \App\Product::where('product_date', '>=', $nowYear . '-' . $nowMonth . '-01')->where('product_date', '<=', $nowYear . '-' . $nowMonth . '-' . $myCarbonFinalDay)->count();


        //현재까지 pba데이터 수량
        $productCount = \App\Product::where('quantity', 1)->count();

        //pba 한도견본 수량
        $pbaCount = \App\Pba::where('division', 'PBA')->count();

        //assy 한도견본 수량
        $assyCount = \App\Pba::where('division', 'ASSY')->count();

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
        // $month_works = \DB::select("
        //     SELECT
        //     SUM(smt) AS smt,
        //     SUM(dip) AS dip,
        //     SUM(aoi) AS aoi,
        //     SUM(wave) AS wave,

        //     SUM(touchup) AS touchup,
        //     SUM(coting) AS coting,

        //     SUM(ass) AS ass,
        //     SUM(packing) AS packing,
        //     SUM(ready) AS ready,
        //     SUM(ect1) AS ect1

        //     FROM workplans where created_at>='$nowYear-$nowMonth-01' and created_at<='$nowYear-$nowMonth-$myCarbonFinalDay'
        //     ");
        //월별 공수 쿼리
        $month_worktasks = \DB::select("
        SELECT process, sum(wt) as wtsum from worktasks where created_at>='$nowYear-$nowMonth-01' and created_at<='$nowYear-$nowMonth-$myCarbonFinalDay' GROUP BY process
            ");
        //dd($month_worktasks[0]->wtsum);

        // 생산수량 어레이-------------------

        // 타입은 array $spc_month
        //dd($month_works);
        $result_array = array(); //$result_array = array배열();    배열공란을 만들어준다.

        foreach ($spc_month as $mon) {
            array_push($result_array, $mon->production);
        }

        $join_arr1 = join("|", $result_array);   // 2414|1250|2648|633|2085|1247|828


        // 공수 어레이-------------------
        $result_array_works = array(); //배열공란을 만들어준다.

        foreach ($month_worktasks as $month_work) {
            array_push(
                $result_array_works,
                $month_work->wtsum,


            );
        }

        $join_arr_work = join(",", $result_array_works);
        //dd($join_arr_work);

        // 월별 공수 합계-------------------
    //     $month_work_sum = \DB::select("
    // SELECT
    // SUM(smt+dip+wave+aoi+touchup+coting+ass+packing+ready+ect1) AS total
    // FROM workplans where created_at>='$nowYear-$nowMonth-01' and created_at<='$nowYear-$nowMonth-$myCarbonFinalDay'
    // ");

    $month_work_sum = \DB::select("
    select sum(wt) as wtsum from worktasks where created_at>='$nowYear-$nowMonth-01' and created_at<='$nowYear-$nowMonth-$myCarbonFinalDay'
    ");

    //월별 공수집계
    $month_work_sum_total = $month_work_sum[0]->wtsum;
       // dd( $month_work_sum_total);
    //dd($month_work_sum[0]->wtsum);

        // $month_work_sum = $month_work_sum;
        // $month_work_sum = ($month_work_sum[0]);

        // 월 어레이------------------------
        $result_array_month = array(); //$result_array = array배열();    배열공란을 만들어준다.

        foreach ($spc_month as $mon) {
            array_push($result_array_month, $mon->pro_month);
        }

        $join_arr2 = join("|", $result_array_month);   // 1|2|3|4|5|6|7

        //var_dump($join_arr2);

        // ----------------------------



        return view('main.main2', compact('year_count', 'month_count', 'nowYear', 'nowMonth', 'hanNowDate', 'spc_month', 'spc_year', 'productCount', 'pbaCount', 'assyCount', 'join_arr1', 'join_arr2', 'month_ppm', 'join_arr_work', 'month_work_sum_total'));
    }

    //월별생산수량
    public function monthProductList()
    {

        $NOW_YMD = (\Config::get('my_carbon.NOW_YMD'));
        $NOW_Y = (\Config::get('my_carbon.NOW_Y'));
        $NOW_M = (\Config::get('my_carbon.NOW_M'));
        $NOW_D = (\Config::get('my_carbon.NOW_D'));
        $D1 = '01';
        //현재 월의 마지막 날
        $myCarbonFinalDay = \Config::get('my_carbon.FINAL_DAY');

        //선택된 시작날짜
        $start_date = request('start_date', $NOW_Y . '-' . $NOW_M . '-' . $D1);

        //선택된 마지막날짜
        $end_date = request('end_date', $NOW_Y . '-' . $NOW_M . '-' . $myCarbonFinalDay);
        //dd(request()->all());

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

        //선택월이 없으면 해당월의 마지막날을 구해서 입력되고, 선택월이 있으면 선택한 월의 마지막날이 입력된다.
        if ($choice == null) {

            $FINAL_DAY = date("t", mktime(0, 0, 0,  $nowMonth, 1, $nowYear));
        } else {

            //선택 월의 마지막 날
            $FINAL_DAY = date("t", mktime(0, 0, 0,  $choice, 1, $nowYear));
        }

        $date_choice = request('date_choice');

        if (request('date_choice')) {

            $month_products = \DB::select("

            SELECT board_name, SUM(quantity) as sum, product_date FROM products where product_date>='$start_date' and product_date<='$end_date' group by board_name,product_date having board_name is not null and board_name <>'' order by product_date DESC
            ");

            $month_products_sum = \DB::select("
            SELECT SUM(quantity) as products_sum FROM products WHERE product_date>='$start_date' AND product_date<='$end_date'
            ");

            $month_count = count($month_products);
        } else {




            //월 선택이 있으면 해당월을 보여주고 월 선택이 없으면 현재월을 보여준다.
            if (isset($choice)) {

                $month_products = \DB::select("

         SELECT board_name, SUM(quantity) as sum, product_date FROM products where product_date>='$nowYear-$choice-01' and product_date<='$nowYear-$choice-$FINAL_DAY' group by board_name,product_date having board_name is not null and board_name <>'' order by product_date DESC
         ");

                $month_products_sum = \DB::select("
         SELECT SUM(quantity) as products_sum FROM products WHERE product_date>='$nowYear-$choice-01' AND product_date<='$nowYear-$choice-$FINAL_DAY'
         ");

                //보드 종류
                $month_count = count($month_products);
            } else {

                $month_products = \DB::select("

         SELECT board_name, SUM(quantity) as sum, product_date FROM products where product_date>='$nowYear-$nowMonth-01' and product_date<='$nowYear-$nowMonth-$FINAL_DAY' group by board_name,product_date having board_name is not null and board_name <>'' order by product_date DESC
         ");

                $month_products_sum = \DB::select("
         SELECT SUM(quantity) as products_sum FROM products WHERE product_date>='$nowYear-$nowMonth-01' AND product_date<='$nowYear-$nowMonth-$FINAL_DAY'
         ");


                //보드 종류
                $month_count = count($month_products);
            }
        }

        //dd($month_products_sum);

        // }

        //년도만 뽑기
        //$yearSelects = Product::selectRaw('YEAR(product_date) as y')->groupBy(\DB::raw('YEAR(product_date)'))->get();

        //dd($month_products);
        //dd($month_products_sum);
        //$yearSelects = $yearSelects->toArray();
        //$ss = count($yearSelects);
        //$yearSelects = $yearSelects->transform();
        //dd($yearSelects);
        //dd($month_products);
        //dd($yearSelects);
        return view('main.month_product_list', compact('month_products', 'nowMonth', 'choice', 'month_count', 'month_products_sum', 'start_date', 'end_date', 'date_choice'));
    }


    public function monthProductListSel()
    {
        $board_name = request('board_name');
        $product_date = request('product_date');

        $results = \App\Product::where('board_name', $board_name)->where('product_date', '>=', $product_date)->where('product_date', '<=', $product_date)->orderBy('board_name', 'desc')->get();

        //보드수량
        $results_count = count($results);
        //dd($results);

        return view('main.month_product_list_board', compact('board_name', 'product_date', 'results', 'results_count'));
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
        $start_date = request('start_date', $NOW_Y . '-' . $NOW_M . '-' . $D1);

        //선택된 마지막날짜
        $end_date = request('end_date', $NOW_Y . '-' . $NOW_M . '-' . $myCarbonFinalDay);

        //보드명 가져오기
        $board_names = \App\Boardname::all();

        //조건으로 pba 가져오기
        // $products = \App\Product::latest()->paginate(30);

        $products = \App\Product::where('board_name', $board_name_search)->where('product_date', '>=', $start_date)->where('product_date', '<=', $end_date)->latest()->get();

        $products_count = count($products);

        $plucked = $products->pluck('serial_name');

        $plucked->all();

        if (request('search')) {

            //검색한 시리얼번호가 없으면
            if (!isset($plucked[0])) {
                Alert::error('찾으려는 보드내역이 없습니다.', '다시 한번 확인해 주세요.');
                // return back();
                // echo "<script>alert(\"찾으려는 값이 없습니다.\");</script>";
                // echo "<meta http-equiv='refresh' content='0; url=http://pcb.test'>";
            }
        }

        //dd($products_count);
        //export($board_names);


        return view('main.board_search_list', compact('board_names', 'board_name_search', 'start_date', 'end_date', 'products', 'products_count'));
    }

    //보드명excel 추출
    public function export($board_name_search, $start_date, $end_date)
    {
        //dd($board_name_search.'/'.$start_date.'/'.$end_date);
        //$this->board_name_search = $board_name_search;
        return Excel::download(
            new BoardsearchExport($board_name_search, $start_date, $end_date),
            $board_name_search . '_' . $start_date . '~' . $end_date . '.xlsx'
        );
        // dd($board_name_search);
        //  return Excel::download(new BoardsearchExport(2020,'6jlxji'), 'qwer.xlsx');
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
        $start_date = request('start_date', $NOW_Y . '-' . $NOW_M . '-' . $D1);

        //선택된 마지막날짜
        $end_date = request('end_date', $NOW_Y . '-' . $NOW_M . '-' . $myCarbonFinalDay);

        //프로젝트 가져오기
        $projects = \App\Project::all();


        if ($shipment_name_choice == null) {
            $shipment_name_choice = "프로젝트명";
        }
        //조건으로 pba 가져오기
        // $products = \App\Product::latest()->paginate(30);

        if (request('set_set') == null) {
            $set_set = 0;
        } else {
            //편성
            $set_set = request('set_set');
        }


        $products = \App\Product::with('user')->where('shipment_daily', $shipment_name_choice)->where('set_set', $set_set)->where('product_date', '>=', $start_date)->where('product_date', '<=', $end_date)->latest()->get();

        $plucked = $products->pluck('serial_name');

        $plucked->all();

        if (request('search')) {

            //검색한 시리얼번호가 없으면
            if (!isset($plucked[0])) {
                Alert::error('찾으려는 출하내역이 없습니다.', '다시 한번 확인해 주세요.');
                // return back();
                // echo "<script>alert(\"찾으려는 값이 없습니다.\");</script>";
                // echo "<meta http-equiv='refresh' content='0; url=http://pcb.test'>";
            }
        }

        $products_count = count($products);

        return view('main.shipment_search_list', compact('projects', 'shipment_name_choice', 'start_date', 'end_date', 'products', 'products_count', 'set_set'));
    }

    //출하내역excel 추출
    public function exportShipment($shipment_name_choice, $start_date, $end_date)
    {
        //dd($shipment_name_choice.'/'.$start_date.'/'.$end_date);
        //$this->board_name_search = $board_name_search;
        return Excel::download(
            new ShipmentSearchExport($shipment_name_choice, $start_date, $end_date),
            $shipment_name_choice . '_' . $start_date . '~' . $end_date . '.xlsx'
        );

        // dd($board_name_search);
        //  return Excel::download(new BoardsearchExport(2020,'6jlxji'), 'qwer.xlsx');
    }
}
