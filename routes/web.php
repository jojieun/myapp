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



Route::post('campaigns/brandstore','CampaignsController@brandStore')->name('campaigns.brandstore');
Route::post('campaigns/firststore','CampaignsController@firstStore')->name('campaigns.firststore');
Route::post('campaigns/secondstore','CampaignsController@secondStore')->name('campaigns.secondstore');
Route::post('campaigns/makearea','CampaignsController@makeArea')->name('campaigns.makearea');
Route::get('campaigns/storeend','CampaignsController@storeEnd')->name('campaigns.storeend');
Route::get('/', [
    'as'=>'main',
    'uses'=>'WelcomeController@index'
]);

//리뷰어마이페이지
Route::get('reviewer/mypage',[
    'as'=>'reviewers.mypage',
    'uses' => 'ReviewerMypageController@home'
]);

//광고주마이페이지
Route::get('advertiser/mypage',[
    'as'=>'advertisers.mypage',
    'uses' => 'AdvertiserMypageController@home'
]);
//임시인플루언서
Route::view('influencer/index','influencers.index')->name('influencers.index'); 
Route::view('influencer/show','influencers.show')->name('influencers.show'); 

//임시캠페인보기
 Route::view('campaign/show','campaigns.show')->name('campaigns.show1');   

//임시 게시판보기
Route::view('athome','athome')->name('athome');
Route::view('visit','visit')->name('visit');
Route::view('ask','ask')->name('ask');
Route::view('faq','faq')->name('faq');
Route::view('notice','notice')->name('notice');
Route::view('ask_list','ask_list')->name('ask_list');

//가입 선택화면
Route::view('register_select','register_select')->name('register.select');

//reviewer 가입 관련
Route::get('reviewer/register',[    
    'as'=>'reviewers.create',
    'uses' => 'ReviewersController@create'
]);
Route::post('reviewer/register',[
    'as'=>'reviewers.store',
    'uses' => 'ReviewersController@store'
]);
//reviewer 인증 관련
Route::get('reviewer/login',[
    'as'=>'sessions.create',
    'uses' => 'SessionsController@create'
]);
Route::post('reviewer/login',[
    'as'=>'sessions.store',
    'uses' => 'SessionsController@store'
]);
Route::get('reviewer/logout',[
    'as'=>'sessions.destory',
    'uses' => 'SessionsController@destory'
]);

//advertiser 가입 관련
Route::get('advertiser/register',[
    'as'=>'advertisers.create',
    'uses' => 'AdvertisersController@create'
]);
Route::post('advertiser/register',[
    'as'=>'advertisers.store',
    'uses' => 'AdvertisersController@store'
]);
//advertiser 인증 관련
Route::get('advertiser/login',[
    'as'=>'advertiser_sessions.create',
    'uses' => 'AdvertisersSessionsController@create'
]);
Route::post('advertiser/login',[
    'as'=>'advertiser_sessions.store',
    'uses' => 'AdvertisersSessionsController@store'
]);
Route::get('advertiser/logout',[
    'as'=>'advertiser_sessions.destory',
    'uses' => 'AdvertisersSessionsController@destory'
]);

/* 소셜 로그인 */
Route::get('social/{provider}', [
    'as' => 'social.login',
    'uses' => 'SocialController@execute',
]);

/* 비밀번호 초기화 */
Route::get('remind', [
    'as' => 'remind.create',
    'uses' => 'PasswordsController@getRemind',
]);
Route::post('remind', [
    'as' => 'remind.store',
    'uses' => 'PasswordsController@postRemind',
]);
Route::get('reset', [
    'as' => 'reset.create',
    'uses' => 'PasswordsController@getReset',
]);
//Route::get('reset', [
//    'as' => 'reset.create',
//    'uses' => 'PasswordsController@getReset',
//]);
Route::post('reset', [
    'as' => 'reset.store',
    'uses' => 'PasswordsController@postReset',
]);


/* 커뮤니티 관련 */
Route::resource('communities', 'CommunitiesController');

/* 캠페인 관련 */
Route::resource('campaigns', 'CampaignsController');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

