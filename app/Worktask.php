<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worktask extends Model
{
    protected $guarded = [];
    public function workplan()
    {
    	return $this->belongsTo(Workplan::class);
    }


}
