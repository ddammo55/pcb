<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boardname extends Model
{
     protected $fillable = ['boardname', 'top_num', 'bot_num', 'man_hour', 'top_method', 'bot_method', 'metal_mask_no', 'dwg_no', 'method', 'note'];
}
