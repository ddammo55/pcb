<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Product;
class MainsController extends Controller
{

	# 현재시간를 불러옴 : \Carbon\Carbon::now();
	# $val = '2015-10-11 11:22:33';
	# $dt = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $val);
    public function index()
    {
    	//현재년월일
    	$val = \Carbon\Carbon::now();
    	//dd($val);
    	//현재 년월일
    	//$nowDate = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $val);

    	//현재 년월일
    	$hanNowDate = $val->format('Y년 m월 d일');

    	//현재 년
    	$nowYear = $val->format('Y');

    	//현재 월
    	$nowMonth = $val->format('m');

    	// 년 생산수량
    	$year_count = \App\Product::where('product_date', '>', $nowYear.'-01-01')->where('product_date', '<' , $nowYear.'-12-31')->count();
    	
        $query_result_month ="

        SELECT 
        ta.pro_month,
        ta.Production,
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
        FROM products WHERE product_date>='2019-01-01' and product_date<='2019-12-31'
        group by MONTH(product_date)) ta 
        ";

        // $con = mysqli_connect('localhost','root','wonho@6356','db1');

        // $re_month = mysqli_query($con,$query_result_month);

        $query_result_year ="

        SELECT 
        ta.pro_month,
        ta.Production,
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
        FROM products WHERE product_date>='2019-01-01' and product_date<='2019-12-31'
        group by YEAR(product_date)) ta 
        ";

        // $re_year = mysqli_query($con,$query_result_year);


    	return view('main.list', compact('year_count', 'nowYear', 'hanNowDate', 're_month', 're_year'));
    }
}
