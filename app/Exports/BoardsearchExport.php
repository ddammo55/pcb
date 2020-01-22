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

    public function __construct(int $year, string $board_name_search)
    {
     //dd($year,$boardname);
      $this->year = $year;
      $this->boardname = $board_name_search;
    }   

    public function query()
    {
        return Product::query()->whereYear('created_at', $this->year)->where('board_name', $this->boardname);
    }
}
