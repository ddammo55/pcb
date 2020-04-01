<?php

//현재년월일
$my_carbon = \Carbon\Carbon::now();

//현재 년월일
$NOW_YMD = $my_carbon->format('Y년 m월 d일');

//현재 년
$NOW_Y = $my_carbon->format('Y');

//현재 월
$NOW_M = $my_carbon->format('m');

//현재 일
$NOW_D = $my_carbon->format('d');

//현재 시간
$NOW_H = $my_carbon->format('h');

//현재 분
$NOW_I = $my_carbon->format('i');

//현재 초
$NOW_S = $my_carbon->format('s');


//매월 마지막 날짜
$FINAL_DAY = date("t", mktime(0, 0, 0,  $NOW_M, 1, $NOW_Y));

return array(
	'NOW_YMD' => $NOW_YMD,
	'NOW_Y' => $NOW_Y,
	'NOW_M' => $NOW_M,
	'NOW_D' => $NOW_D,
	'NOW_H' => $NOW_H,
	'NOW_I' => $NOW_I,
	'NOW_S' => $NOW_S,
	'FINAL_DAY' => $FINAL_DAY
	 );
