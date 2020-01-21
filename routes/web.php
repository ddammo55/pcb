<?php

// Route::get('/', function () {
//     return view('welcome');
// });

#|--------------------------------------------------------------------------
#| 메인
#|--------------------------------------------------------------------------
Route::get('/', 'SpcsController@index');
//Route::get('/', 'PostsController@index');




#|--------------------------------------------------------------------------
#| 로그인
#|--------------------------------------------------------------------------
// Route::get('/user/login', [
// 	'as' => 'login',
// 	'uses' => 'SessionController@create',
// ]);
Route::get('login', function () {
    auth()->loginUsingId(1);
    return redirect()->intended();
});

Auth::routes(['verify' => true]);






#|--------------------------------------------------------------------------
#| 사용자 메일인증, 멤버, 멤버 정보 수정
#|--------------------------------------------------------------------------
// Auth::routes(['verify' => true]);
Route::get('/member', 'TeamMembersController@show')->middleware('lv3');
//Route::get('/member_modify/{user}edit', 'TeamMembersController@member_modify')->middleware('lv3');
Route::POST('/member_modify/{user}/edit','TeamMembersController@member_modify');
Route::PATCH('/member_modify/{user}','TeamMembersController@member_update');

#|--------------------------------------------------------------------------
#| 프로파일
#|--------------------------------------------------------------------------
// Route::get('profile', function () {
//    return view('profile');
// })->middleware('verified');
Route::get('/profile', 'ProfileController@index')->name('profile')->middleware('auth');
Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update')->middleware('auth');

#|--------------------------------------------------------------------------
#| 작업지시 게시판
#|--------------------------------------------------------------------------
Route::resource('/posts','PostsController');

#|--------------------------------------------------------------------------
#| 시리얼번호 입력
#|--------------------------------------------------------------------------
Route::resource('/product','ProductController')->middleware('lv2');
Route::post('/product_create',['as' => 'product_create', 'uses' => 'ProductController@product_create'])->middleware('lv2');

#|--------------------------------------------------------------------------
#| 프로젝트 관리
#|--------------------------------------------------------------------------
Route::resource('/projects','ProjectsController')->middleware('lv3');

#|--------------------------------------------------------------------------
#| 보드명 관리
#|--------------------------------------------------------------------------
Route::resource('/boardnames','BoardnamesController')->middleware('lv3');

#|--------------------------------------------------------------------------
#| 출하내역 관리
#|--------------------------------------------------------------------------
Route::resource('/shipment','ShipmentsController')->middleware('lv2');
Route::post('product/con/{id}', 'ShipmentsController@con')->middleware('lv2');
Route::post('shipmentss', 'ShipmentsController@update')->middleware('lv2');
Route::get('/serialNameSearch','ShipmentsController@serialNameSearch');  // master에서 검색

Route::get('/monthProductList','SpcsController@monthProductList')->middleware('lv2');  // 월 생산수량
Route::get('/monthProductListSel','SpcsController@monthProductListSel')->middleware('lv2'); //월 생산 보드 클릭 보여줄 리스트 
Route::get('/boardSearchList','SpcsController@boardSearchList')->middleware('lv2'); // 보드내역 별 검색
Route::get('/shipmentSearchList','SpcsController@shipmentSearchList')->middleware('lv2'); // 보드내역 별 검색


#|--------------------------------------------------------------------------
#| PBA제조영상
#|--------------------------------------------------------------------------
Route::resource('/pbas','PbasController')->middleware('lv2');
Route::get('/pbas/{pba}/view', 'PbasController@view')->middleware('lv2');

#|assy_create
Route::get('/assys/create', 'PbasController@assycreate')->middleware('lv3');
Route::post('/assys/assy_create', 'PbasController@storeassy')->middleware('lv3');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

#|--------------------------------------------------------------------------
#| 댓글
#|--------------------------------------------------------------------------
Route::post('/pbas/{pba}/tasks/', 'PbaTasksController@store')->middleware('auth');
Route::patch('/tasks/{task}', 'PbaTasksController@update')->middleware('auth');

#|--------------------------------------------------------------------------
#| 공수 작업지시 working time
#|--------------------------------------------------------------------------
Route::resource('/works','WorksController')->middleware('lv2');
Route::patch('/workComplate/{work}','WorksController@complate');

Route::get('works2','WorksController@workform');

//cookie
Route::get('/cookie/cookie','CookieController@cookie');
Route::get('/cookie/cookie_ok','CookieController@cookie_ok');

