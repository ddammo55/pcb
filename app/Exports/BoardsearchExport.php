<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class BoardsearchExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
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


        return Product::all();
    }
}
