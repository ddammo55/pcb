<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function pba()
    {
    	return $this->belongsTo(Pba::class);
    }
}
