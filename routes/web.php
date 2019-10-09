<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [
    'as'=>'main',
    'uses'=>'WelcomeController@index'
]);

//리뷰어마이페이지
Route::get('reviewer/mypage',[
    'as'=>'reviewers.mypage',
    'uses' => 'ReviewerMypageController@home'
]);

//임시 게시판보기
Route::view('athome','athome')->name('athome');
Route::view('visit','visit')->name('visit');
Route::view('ask','ask')->name('ask');
Route::view('faq','faq')->name('faq');
Route::view('notice','notice')->name('notice');
Route::view('ask_list','ask_list')->name('ask_list');

//가입 선택화면
Route::view('auth/register_select','register_select')->name('register.select');
//reviewer 가입 관련
Route::get('auth/register',[
    
    'as'=>'reviewers.create',
    'uses' => 'ReviewersController@create'
]);
Route::post('auth/register',[
    'as'=>'reviewers.store',
    'uses' => 'ReviewersController@store'
]);
//reviewer 인증 관련
Route::get('auth/login',[
    'as'=>'sessions.create',
    'uses' => 'SessionsController@create'
]);
Route::post('auth/login',[
    'as'=>'sessions.store',
    'uses' => 'SessionsController@store'
]);
Route::get('auth/logout',[
    'as'=>'sessions.destory',
    'uses' => 'SessionsController@destory'
]);

//advertiser 가입 관련
Route::get('auth/advertiser_register',[
    'as'=>'advertisers.create',
    'uses' => 'AdvertisersController@create'
]);
Route::post('auth/advertiser_register',[
    'as'=>'advertisers.store',
    'uses' => 'AdvertisersController@store'
]);
//advertiser 인증 관련
Route::get('auth/advertiser_login',[
    'as'=>'advertiser_sessions.create',
    'uses' => 'AdvertisersSessionsController@create'
]);
Route::post('auth/advertiser_login',[
    'as'=>'advertiser_sessions.store',
    'uses' => 'AdvertisersSessionsController@store'
]);
Route::get('auth/advertiser_logout',[
    'as'=>'advertiser_sessions.destory',
    'uses' => 'AdvertisersSessionsController@destory'
]);

/* 소셜 로그인 */
Route::get('social/{provider}', [
    'as' => 'social.login',
    'uses' => 'SocialController@execute',
]);

/* 비밀번호 초기화 */
Route::get('auth/remind', [
    'as' => 'remind.create',
    'uses' => 'PasswordsController@getRemind',
]);
Route::post('auth/remind', [
    'as' => 'remind.store',
    'uses' => 'PasswordsController@postRemind',
]);
Route::get('auth/reset/{token}', [
    'as' => 'reset.create',
    'uses' => 'PasswordsController@getReset',
]);
    
//    ->where('token', '[\pL-\pN]{64}');
Route::post('auth/reset', [
    'as' => 'reset.store',
    'uses' => 'PasswordsController@postReset',
]);


/* 커뮤니티 관련 */
Route::resource('communities', 'CommunitiesController');






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

