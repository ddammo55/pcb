<?php

use App\Project;
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

$factory->define(Project::class, function (Faker $faker) {
    return [
        'project_name' => str_random(6),
        'project_code' => str_random(6),
        'car' => rand(10,99),
        'kinds' => str_random(10), 
        'note' => str_random(6),   
    ];
});
