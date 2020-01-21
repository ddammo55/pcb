<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = ['serial_name', 'product_date', 'shipment', 'note'];
}
