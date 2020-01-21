<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pba extends Model
{
    protected $fillable = ['project_name', 'board_name', 'assy_name', 'content', 'division', 'wr_user'];

    public function tasks()
    {
    	return $this->hasMany(Task::class);
    }
}
