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

//캠페인관련
Route::match(['get', 'post'], 'visit','CampaignsController@indexV')->name('visit');
Route::get('athome','CampaignsController@indexH')->name('athome');
Route::get('campaign/show/{campaign}/{d}/{applyCount}/{locaOrCate?}','CampaignsController@show')->name('campaigns.show')->where('locaOrCate', '.*');
//카테고리별로보기
//Route::post('campaigns/visit','CampaignsController@index_cate')->name('campaigns.index_cate');


//관리자페이지메인
Route::get('admin','AdminController@index')->name('admin');
//캠페인검수 승인
Route::post('admin/confirmcampaign', 'AdminController@confirmCampaign')->name('admin.confirmcampaign');
//관리자-리뷰어회원목록
Route::get('admin/reviewers','AdminController@reveiwerslist')->name('admin.reviewers');
//관리자-리뷰어회원목록
Route::get('admin/plan/{id}','AdminController@plan')->name('admin.plan');

//메인페이지
Route::get('/origin', [
    'as'=>'main',
    'uses'=>'WelcomeController@index'
]);

//리뷰어마이페이지
Route::get('reviewer/mypage',[
    'as'=>'reviewers.mypage',
    'uses' => 'ReviewerMypageController@home'
]);
//리뷰어캠페인신청
Route::post('reviewer/apply',[
    'as'=>'reviewers.apply',
    'uses' => 'ReviewerMypageController@apply'
]);

//광고주마이페이지
Route::get('advertiser/mypage',[
    'as'=>'advertisers.mypage',
    'uses' => 'AdvertiserMypageController@home'
]);
Route::get('advertiser/managecampaign',[
    'as'=>'advertisers.managecampaign',
    'uses' => 'AdvertiserMypageController@manageCampaign'
]);



//임시인플루언서
Route::view('influencer/index','influencers.index')->name('influencers.index'); 
Route::view('influencer/show','influencers.show')->name('influencers.show'); 

//임시캠페인보기
 Route::view('campaign/show','campaigns.show')->name('campaigns.show1');   

//임시 게시판보기
Route::view('ask','ask')->name('ask');
Route::view('faq','faq')->name('faq');
Route::view('notice','notice')->name('notice');
Route::view('ask_list','ask_list')->name('ask_list');

//가입 선택화면
Route::view('register_select','register_select')->name('register.select');

///////////////////////////////////
//reviewer **임시** 가입 관련
Route::get('/', [
    'as'=>'temp_home',
    'uses'=>'WelcomeController@tempindex'
]);
Route::get('reviewer/pre_register',[    
    'as'=>'reviewers.temp_create',
    'uses' => 'ReviewersController@tempcreate'
]);
Route::post('reviewer/pre_register',[
    'as'=>'reviewers.temp_store',
    'uses' => 'ReviewersController@tempstore'
]);
Route::get('plan/pre_create',[
    'as'=>'plans.temp_create',
    'uses' => 'PlansController@tempcreate'
]);
Route::post('plan/pre_create',[
    'as'=>'plans.temp_store',
    'uses' => 'PlansController@tempstore'
]);

/////////////////////////////////////////

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
Route::resource('campaigns', 'CampaignsController')->except([
    'show'
]);

/* 리뷰전략 관련 */
Route::get('plans/showmy/{id}',[
    'as'=>'plans.showmy',
    'uses' => 'PlansController@showMy'
]);
Route::resource('plans', 'PlansController');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

