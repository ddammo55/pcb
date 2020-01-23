<?php

namespace App\Exports;

use App\Product;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ShipmentSearchExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
       use Exportable;

    public function __construct(string $shipment_name_choice, string $start_date, string $end_date)
    {
     //dd($year,$boardname);
      //$this->year = $year;
      //dd($board_name_search. $start_date.$end_date);
      $this->shipment_name_choice = $shipment_name_choice;
      $this->start_date = $start_date;
      $this->end_date = $end_date;
    }

    public function query()
    {
       // return Product::query()->whereYear('created_at', $this->year)->where('board_name', $this->boardname);
       return Product::query()->where('shipment_daily', $this->shipment_name_choice)->where('product_date', '>=', $this->start_date)->where('product_date', '<=', $this->end_date);
    }
}
