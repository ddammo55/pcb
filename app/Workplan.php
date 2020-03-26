<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workplan extends Model
{
    protected $guarded = [];

    public function Worktasks()
    {
    	return $this->hasMany(Worktask::class);
    }


}
