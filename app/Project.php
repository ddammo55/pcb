<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	 //public $table = "projects";
    protected $fillable = ['project_name', 'project_code', 'car', 'kinds', 'note'];
}
