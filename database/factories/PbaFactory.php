<?php

use App\Pba;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Pba::class, function (Faker $faker) {
    return [
        'project_name' => str_random(6),  
        'board_name' => str_random(6),  
        'content' => "<p><img src='/photos/shares/sample.jpg'></p>", 
        'division' => "PBA", 
        'created_at' => now(),
        'wr_user' => "홍길동",
    ];
});