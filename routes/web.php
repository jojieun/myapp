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

//메인페이지
Route::get('/origin', [
    'as'=>'main',
    'uses'=>'WelcomeController@index'
]);

/********캠페인**********/
Route::post('campaigns/brandstore','CampaignsController@brandStore')->name('campaigns.brandstore');
Route::post('campaigns/firststore','CampaignsController@firstStore')->name('campaigns.firststore');
Route::post('campaigns/secondstore','CampaignsController@secondStore')->name('campaigns.secondstore');
Route::post('campaigns/makearea','CampaignsController@makeArea')->name('campaigns.makearea');
Route::get('campaigns/storeend','CampaignsController@storeEnd')->name('campaigns.storeend');

Route::match(['get', 'post'], 'visit','CampaignsController@indexV')->name('visit');
Route::match(['get', 'post'],'athome', 'CampaignsController@indexH')->name('athome');
Route::get('campaign/show/{campaign}/{d}/{applyCount}/{locaOrCate?}','CampaignsController@show')->name('campaigns.show')->where('locaOrCate', '.*');
Route::resource('campaigns', 'CampaignsController')->except([
    'show'
]);

/********고객센터**********/
//1:1문의하기
Route::resource('onetoones', 'OnetooneController');
//리뷰어 자주묻는질문
Route::resource('reveiwer_faqs', 'ReviewerFaqController');
//광고주 자주묻는질문
Route::resource('advertiser_faqs', 'AdvertiserFaqController');
//공지사항
Route::resource('notices', 'NoticeController');

Route::view('ask','ask')->name('ask');
Route::view('faq','faq')->name('faq');
Route::view('notice','notice')->name('notice');
Route::view('ask_list','ask_list')->name('ask_list');

/******** 관리자admin **********/
//관리자admin페이지메인
Route::get('admin','AdminController@index')->name('admin');
//admin로그인
Route::get('admin/login','AdminController@login')->name('admin.login');
//admin로그인저장
Route::post('admin/login','AdminController@store')->name('admin.loginstore');
//admin로그아웃
Route::get('admin/logout','AdminController@destory')->name('admin.logout');
//캠페인검수 승인
Route::post('admin/confirmcampaign', 'AdminController@confirmCampaign')->name('admin.confirmcampaign');
//관리자-리뷰어회원목록
Route::get('admin/reviewers','AdminController@reveiwerslist')->name('admin.reviewers');
//관리자-리뷰어회원->리뷰전략보기
Route::get('admin/plan/{id}','AdminController@plan')->name('admin.plan');

//관리자-미답변 일대일문의 목록
Route::get('admin/notanswer','AdminController@notAnswerO')->name('admin.notanswer');
//관리자-미답변 일대일문의 답변창
Route::post('admin/openanswer/{id}','AdminController@openAnswer')->name('admin.openanswer');
//관리자-미답변 일대일문의 답변저장하기
Route::post('admin/saveanswer/{onetoone}','AdminController@saveAnswer')->name('admin.saveanswer');
//관리자-답변완료 일대일문의 목록
Route::get('admin/answer','AdminController@AnswerO')->name('admin.answer');
Route::post('admin/openanswer/{id}','AdminController@openAnswer')->name('admin.openanswer');
//관리자-답변완료 일대일문의 답변 수정하기
Route::post('admin/saveanswer2/{onetoone}','AdminController@saveAnswer2')->name('admin.saveanswer2');

//관리자-일대일문의 카테고리 보기
Route::get('admin/showQCategory','AdminController@showQCategory')->name('admin.showQCategory');
//관리자-일대일문의 카테고리 저장 ajax
Route::post('admin/makeQCategory','AdminController@makeQCategory')->name('admin.makeQCategory');
//관리자-일대일문의 카테고리 삭제
Route::delete('admin/delQCategory/{id}','AdminController@delQCategory');



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
//리뷰어북마크
Route::post('reviewer/bookmark',[
    'as'=>'reviewers.bookmark',
    'uses' => 'ReviewerMypageController@bookmark'
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
Route::post('reset', [
    'as' => 'reset.store',
    'uses' => 'PasswordsController@postReset',
]);


/* 커뮤니티 관련 */
Route::resource('communities', 'CommunitiesController');

/* 리뷰전략 관련 */
Route::get('plans/showmy/{id}',[
    'as'=>'plans.showmy',
    'uses' => 'PlansController@showMy'
]);
Route::resource('plans', 'PlansController');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

