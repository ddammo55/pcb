<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
    	'pba_id' => rand(10,50),
    	'description' =>  "안녕하세요 저는 댓글입니다. 특이사항 및 토론을 작성하는 곳입니다.",
    	'wr_user' => "홍길동",
    ];
});
