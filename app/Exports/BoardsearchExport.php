<?php

namespace App\Exports;

use App\Product;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
class BoardsearchExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
       use Exportable;

    public function __construct(string $board_name_search, string $start_date, string $end_date)
    {
     //dd($year,$boardname);
      //$this->year = $year;
      $this->boardname = $board_name_search;
      $this->start_date = $start_date;
      $this->end_date = $end_date;
    }

    public function query()
    {
       // return Product::query()->whereYear('created_at', $this->year)->where('board_name', $this->boardname);
       return Product::query()->where('board_name', $this->boardname)->where('product_date', '>=', $this->start_date)->where('product_date', '<=', $this->end_date);
    }
}
