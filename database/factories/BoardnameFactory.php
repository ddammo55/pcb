<?php

use App\Boardname;
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

$factory->define(Boardname::class, function (Faker $faker) {
    return [
        'boardname' => str_random(6),
        'top_num' => rand(10,99),
        'bot_num' => rand(10,99),
        'top_method' => "크림솔더",
        'bot_method' => "본드",
        'bot_method' => "본드",
        'man_hour' => rand(10,1000),
        'metal_mask_no' => rand(10,99),
        'dwg_no' => "R1D000001",
        'method' => str_random(3), 
        'note' => str_random(10),   
    ];
});