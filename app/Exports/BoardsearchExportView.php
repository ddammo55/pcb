<?php

namespace App\Exports;

use App\Product;
//use Illuminate\Http\Request;
//use Illuminate\View\View;
use Illuminate\Contracts\View\View;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class BoardsearchExportView implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function view() : View
    {
        return view('main.table', [
        		'products' => Product::all()
        ]);
    }
}
