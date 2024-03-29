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
Route::get('/', [
    'as'=>'main',
    'uses'=>'WelcomeController@index'
]);
//header검색
Route::get('/search', 'WelcomeController@search')->name('search');
//개인정보취급방침
Route::view('privacy_policy', 'privacy_policy')->name('privacy_policy');
//개인정보취급방침
Route::view('terms_of_use', 'terms_of_use')->name('terms_of_use');


/********캠페인**********/
Route::post('campaigns/brandstore','CampaignsController@brandStore')->name('campaigns.brandstore');
Route::post('campaigns/brandCheck','CampaignsController@brandCheck')->name('campaigns.brandCheck');
Route::post('campaigns/firststore','CampaignsController@firstStore')->name('campaigns.firststore');
Route::post('campaigns/firststore2','CampaignsController@firstStore2')->name('campaigns.firststore2');
Route::post('campaigns/secondstore','CampaignsController@secondStore')->name('campaigns.secondstore');
Route::post('campaigns/makearea','CampaignsController@makeArea')->name('campaigns.makearea');
//이전캠페인 불러오기
Route::get('campaigns/before_campaign','CampaignsController@before_campaign')->name('campaigns.before_campaign');
//ajax 저장
Route::post('campaigns/store_c','CampaignsController@store_c')->name('campaigns.store_c');
Route::post('campaigns/complate','CampaignsController@complate')->name('campaigns.complate');
Route::get('campaigns/storeend','CampaignsController@storeEnd')->name('campaigns.storeend');

Route::post('campaigns/update_c/{oldcamId}','CampaignsController@update_c')->name('campaigns.update_c');

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
Route::post('reviewer_faqs/editShow/{reviewerFaq}', 'ReviewerFaqController@editShow');
Route::match(['get', 'post'],'reviewer_faqs_list/{nowc}', 'ReviewerFaqController@index')->name('reviewer_faqs.index');
Route::resource('reviewer_faqs', 'ReviewerFaqController');
//광고주 자주묻는질문
Route::post('advertiser_faqs/editShow/{advertiserFaq}', 'AdvertiserFaqController@editShow');
Route::match(['get', 'post'],'advertiser_faqs_list/{nowc}', 'AdvertiserFaqController@index')->name('advertiser_faqs.index');
Route::resource('advertiser_faqs', 'AdvertiserFaqController');
//공지사항 검색
Route::get('notices/search', 'NoticeController@search')->name('notice.search');
//공지사항
Route::resource('notices', 'NoticeController');


/********커뮤니티**********/
//공지사항 검색
Route::get('communities/search', 'CommunitiesController@search')->name('communities.search');
Route::post('makecomment','CommunitiesController@makecomment')->name('makecomment');
//댓글삭제
Route::post('delcomment/{comment}','CommunitiesController@delcomment')->name('delcomment');
Route::resource('communities', 'CommunitiesController');


/********리뷰전략 인플루언서**********/
//리뷰(어)제안할 캠페인 가져오기
Route::get('plans/suggestion_campaign',[
    'as'=>'plans.suggestion_campaign',
    'uses' => 'PlansController@suggestion_campaign'
]);
//리뷰(어)제안하기
Route::post('plans/reviewer_suggestion',[
    'as'=>'plans.reviewer_suggestion',
    'uses' => 'PlansController@reviewer_suggestion'
]);
//나의 리뷰전략 보기
Route::get('plans/showmy/{id}',[
    'as'=>'plans.showmy',
    'uses' => 'PlansController@showMy'
]);
//카테고리기능이 들어간 인플루언서 index
Route::match(['get', 'post'],'influencer/index', 'PlansController@index')->name('influencers.index');
Route::resource('plans', 'PlansController')->except([
    'index'
]);


/******** 관리자admin **********/
//관리자admin페이지메인
Route::get('admin','AdminController@index')->name('admin');
//admin로그인
Route::get('admin/login','AdminController@login')->name('admin.login');
//admin로그인저장
Route::post('admin/login','AdminController@store')->name('admin.loginstore');
//admin로그아웃
Route::get('admin/logout','AdminController@destory')->name('admin.logout');

/**** 관리자admin **********회원 ****/
//관리자-리뷰어회원목록
Route::get('admin/reviewers','AdminController@reveiwerslist')->name('admin.reviewers');
//관리자-리뷰어회원->리뷰전략보기
Route::get('admin/plan/{id}','AdminController@plan')->name('admin.plan');
//관리자-리뷰어회원->sns보기
Route::get('admin/sns/{reviewerid}','AdminController@sns')->name('admin.sns');
//관리자 리뷰어 목록 다운로드
Route::get('admin/down_reviewer', 'AdminController@down_reviewer')->name('admin.down_reviewer');
//관리자-광고주회원목록
Route::get('admin/advertisers','AdminController@advertisers')->name('admin.advertisers');
//관리자 광고주 목록 다운로드
Route::get('admin/down_advertiser', 'AdminController@down_advertiser')->name('admin.down_advertiser');

/**** 관리자admin **********캠페인 ****/
//캠페인검수대기목록
Route::get('admin/waitConfirmCam', 'AdminController@waitConfirmCam')->name('admin.waitConfirmCam');
//캠페인검수대기목록 - show
Route::get('admin/showwait/{campaign}', 'AdminController@showwait')->name('admin.showwait');
//캠페인검수 승인
Route::post('admin/confirmcampaign', 'AdminController@confirmCampaign')->name('admin.confirmcampaign');
//캠페인검수 수정창 열어오기
Route::get('admin/edit_a/{campaign}','CampaignsController@edit_a')->name('admin.edit_a');
//캠페인검수 수정 열어오기
Route::post('admin/update_a','CampaignsController@update_a')->name('campaigns.update_a');

//수정요청 캠페인
Route::get('admin/modify_campaign', 'AdminController@modify_campaign')->name('admin.modify_campaign');
//수정요청 캠페인 - show
Route::get('admin/show_modify/{modify_campaign}/{campaign}', 'AdminController@show_modify')->name('admin.show_modify');
//캠페인검수 승인
Route::post('admin/confirmModify', 'AdminController@confirmModify')->name('admin.confirmModify');

//리뷰어 모집중 캠페인
Route::get('admin/recruit_cam', 'AdminController@recruit_cam')->name('admin.recruit_cam');
//리뷰어 모집중 캠페인-- 신청 리뷰어 보기
Route::post('admin/recruit_reviewer/{camId}', 'AdminController@recruit_reviewer')->name('admin.recruit_reviewer');
//리뷰어 모집중 캠페인 --노출옵션수정
Route::post('admin/exposure_purchase_make/{camId}', 'AdminController@exposure_purchase_make')->name('admin.exposure_purchase_make');

// 리뷰 진행중 캠페인
Route::get('admin/submit_cam', 'AdminController@submit_cam')->name('admin.submit_cam');
//리뷰어 모집중 캠페인-- 선정 리뷰어 보기
Route::post('admin/submit_reviewer/{camId}', 'AdminController@submit_reviewer')->name('admin.submit_reviewer');
// 완료 캠페인
Route::get('admin/end_cam', 'AdminController@end_cam')->name('admin.end_cam');

// 미제출 리뷰어(블랙리스트)
Route::get('admin/black_list', 'AdminController@black_list')->name('admin.black_list');

//관리자- 패널티 저장 ajax
Route::post('storePenalty','PenaltyController@store')->name('storePenalty');
//관리자- 패널티 삭제
Route::delete('delPenalty/{penalty}','PenaltyController@delete');


/**** 관리자admin **********옵션 ****/
//캠페인 노출옵션 구매내역
Route::get('admin/exposure_purchase', 'AdminController@exposure_purchase')->name('admin.exposure_purchase');
//캠페인 노출옵션 구매내역 수정
Route::post('admin/exposure_purchase_update/{campaign_exposure}', 'AdminController@exposure_purchase_update')->name('admin.exposure_purchase_update');
//캠페인 홍보 구매내역
Route::get('admin/promotion_purchase', 'AdminController@promotion_purchase')->name('admin.promotion_purchase');
//캠페인 홍보 구매내역 수정 (처리확인)
Route::get('admin/promotion_purchase_update/{campaign_promotion}', 'AdminController@promotion_purchase_update')->name('admin.promotion_purchase_update');
//캠페인 노출 옵션 설정
Route::get('admin/exposure', 'AdminController@exposure')->name('admin.exposure');
//캠페인 노출 옵션 수정 열기
Route::get('admin/edit_exposure/{exposure}', 'AdminController@edit_exposure')->name('admin.edit_exposure');
//캠페인 노출 옵션 업데이트
Route::put('admin/update_exposure/{exposure}', 'AdminController@update_exposure')->name('admin.update_exposure');
//캠페인 홍보 옵션 설정
Route::get('admin/promotion', 'AdminController@promotion')->name('admin.promotion');
//캠페인 홍보 옵션 수정 열기
Route::get('admin/edit_promotion/{promotion}', 'AdminController@edit_promotion')->name('admin.edit_promotion');
//캠페인 홍보 옵션 업데이트
Route::put('admin/update_promotion/{promotion}', 'AdminController@update_promotion')->name('admin.update_promotion');


//캠페인 대행의뢰 목록
Route::get('admin/agency', 'AgencyController@admin_index')->name('admin.agency');

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

//관리자-포인트 출금신청내역
Route::get('admin/apply_deposits','AdminController@apply_deposits')->name('admin.apply_deposits');
//관리자-포인트 출금신청처리
Route::post('admin/process_deposits','AdminController@process_deposits')->name('admin.process_deposits');
//관리자-포인트 출금완료내역
Route::get('admin/complete_deposits','AdminController@complete_deposits')->name('admin.complete_deposits');

//관리자-리뷰어FAQ 카테고리 보기
Route::get('admin/rFAQCategory','AdminController@rFAQCategory')->name('admin.rFAQCategory');
//관리자-리뷰어FAQ 카테고리 저장 ajax
Route::post('admin/saverFAQCategory','AdminController@saverFAQCategory')->name('admin.saverFAQCategory');
//관리자-리뷰어FAQ 카테고리 삭제
Route::delete('admin/delrFAQCategory/{id}','AdminController@delrFAQCategory');

//관리자-광고주FAQ 카테고리 보기
Route::get('admin/aFAQCategory','AdminController@aFAQCategory')->name('admin.aFAQCategory');
//관리자-리뷰어FAQ 카테고리 저장 ajax
Route::post('admin/saveaFAQCategory','AdminController@saveaFAQCategory')->name('admin.saveaFAQCategory');
//관리자-리뷰어FAQ 카테고리 삭제
Route::delete('admin/delaFAQCategory/{id}','AdminController@delaFAQCategory');

//관리자-메인배너관리
Route::get('admin/main_banner_edit','AdminController@main_banner_edit')->name('admin.main_banner_edit');
//관리자-메인배너관리-수정
Route::post('admin/main_banner_modi/{main_banner}','AdminController@main_banner_modi')->name('admin.main_banner_modi');
//관리자-메인배너관리-삭제
Route::get('admin/main_banner_del/{main_banner}','AdminController@main_banner_del')->name('admin.main_banner_del');
//관리자-메인배너관리-추가
Route::post('admin/main_banner_add','AdminController@main_banner_add')->name('admin.main_banner_add');

//관리자-중단배너관리
Route::get('admin/middle_banner_edit','AdminController@middle_banner_edit')->name('admin.middle_banner_edit');
//관리자-중단배너관리-수정
Route::post('admin/middle_banner_modi/{middle_banner}','AdminController@middle_banner_modi')->name('admin.middle_banner_modi');
//관리자-중단배너관리-삭제
Route::get('admin/middle_banner_del/{middle_banner}','AdminController@middle_banner_del')->name('admin.middle_banner_del');
//관리자-중단배너관리-추가
Route::post('admin/middle_banner_add','AdminController@middle_banner_add')->name('admin.middle_banner_add');

//관리자-하단배너관리
Route::get('admin/bottom_banner_edit','AdminController@bottom_banner_edit')->name('admin.bottom_banner_edit');
//관리자-하단배너관리-수정
Route::post('admin/bottom_banner_modi/{bottom_banner}','AdminController@bottom_banner_modi')->name('admin.bottom_banner_modi');
//관리자-하단배너관리-삭제
Route::get('admin/bottom_banner_del/{bottom_banner}','AdminController@bottom_banner_del')->name('admin.bottom_banner_del');
//관리자-하단배너관리-추가
Route::post('admin/bottom_banner_add','AdminController@bottom_banner_add')->name('admin.bottom_banner_add');

//관리자-AI빅데이터 관리
Route::get('admin/ai_bigdata','AdminController@ai_bigdata')->name('admin.ai_bigdata');



/******리뷰어마이페이지*********/
//새메시지 개수 리턴
Route::get('new_messages',[
    'as'=>'new_messages',
    'uses' => 'SessionsController@get_new_message'
]);

//마이페이지 메인
Route::get('reviewer/mypage',[
    'as'=>'reviewers.mypage',
    'uses' => 'ReviewerMypageController@home'
]);
//방문 수취 확인(ajax)
Route::post('reviewer/take_visit',[
    'as'=>'reviewers.take_visit',
    'uses' => 'ReviewerMypageController@take_visit'
]);
//리뷰제출(ajax리뷰만들기)
Route::post('reviewer/create_review',[
    'as'=>'reviewers.create_review',
    'uses' => 'ReviewerMypageController@create_review'
]);
//리뷰수정
Route::get('reviewer/edit_review/{review}',[
    'uses' => 'ReviewerMypageController@edit_review'
]);
//리뷰수정입력
Route::put('reviewer/update_review/{review}',[
    'uses' => 'ReviewerMypageController@update_review'
]);
//나의캠페인
Route::get('reviewer/my_campaign',[
    'as'=>'reviewers.my_campaign',
    'uses' => 'ReviewerMypageController@my_campaign'
]);

//미제출리뷰
Route::get('reviewer/not_submit',[
    'as'=>'reviewers.not_submit',
    'uses' => 'ReviewerMypageController@not_submit'
]);
//리뷰어캠페인신청
Route::post('reviewer/apply',[
    'as'=>'reviewers.apply',
    'uses' => 'ReviewerMypageController@apply'
]);
//리뷰어북마크(하기 ajax)
Route::post('reviewer/bookmark',[
    'as'=>'reviewers.bookmark',
    'uses' => 'ReviewerMypageController@bookmark'
]);
//리뷰전략열람정보
Route::get('reviewer/plan_reading',[
    'as'=>'reviewers.plan_reading',
    'uses' => 'ReviewerMypageController@plan_reading'
]);
//리뷰전략열람정보 연관 모집중캠페인 보기 Ajax
Route::get('reviewer/show_campaign/{adId}',[
    'uses' => 'ReviewerMypageController@show_campaign'
]);
//리뷰어 제안 내역
Route::get('reviewer/suggestion',[
    'as'=>'reviewers.suggestion',
    'uses' => 'ReviewerMypageController@suggestion'
]);
//리뷰어제안 거절
Route::post('reviewer/no_accept/{suggestId}',[
    'uses' => 'ReviewerMypageController@no_accept'
]);
//관심캠페인 목록 보기
Route::get('reviewer/bookmark_list',[
    'as'=>'reviewers.bookmark_list',
    'uses' => 'ReviewerMypageController@bookmark_list'
]);
//관심캠페인 삭제
Route::post('reviewer/delete_bookmark/{bookmarkId}',[
    'uses' => 'ReviewerMypageController@delete_bookmark'
]);
//나의 포인트
Route::get('reviewer/point',[
    'as'=>'reviewers.point',
    'uses' => 'ReviewerMypageController@point'
]);
//나의 포인트 검색
Route::post('reviewer/point_search',[
    'as'=>'reviewers.point_search',
    'uses' => 'ReviewerMypageController@point_search'
]);
//포인트 출금신청
Route::get('reviewer/withdraw',[
    'as'=>'reviewers.withdraw',
    'uses' => 'ReviewerMypageController@withdraw'
]);
//포인트 출금신청처리
Route::post('reviewer/save_withdraw',[
    'as'=>'reviewers.save_withdraw',
    'uses' => 'ReviewerMypageController@save_withdraw'
]);
//회원정보수정
Route::get('reviewer/edit_info',[
    'as'=>'reviewers.edit_info',
    'uses' => 'ReviewerMypageController@edit_info'
]);
//회원정보업데이트
Route::put('reviewer/update_info/{reviewer}',[
    'as'=>'reviewers.update_info',
    'uses' => 'ReviewerMypageController@update_info'
]);
//소셜회원_회원정보업데이트
Route::put('reviewer/update_info2/{reviewer}',[
    'as'=>'reviewers.update_info2',
    'uses' => 'ReviewerMypageController@update_info2'
]);
//mysns
Route::get('reviewer/mysns',[
    'as'=>'reviewers.mysns',
    'uses' => 'ReviewerMypageController@mysns'
]);
//mysns업데이트
Route::put('reviewer/update_mysns',[
    'as'=>'reviewers.update_mysns',
    'uses' => 'ReviewerMypageController@update_mysns'
]);

/******광고주마이페이지*********/
//마이페이지 메인
Route::get('advertiser/mypage',[
    'as'=>'advertisers.mypage',
    'uses' => 'AdvertiserMypageController@home'
]);
//포인트목록
Route::get('advertiser/refund_point',[
    'as'=>'advertiser.refund_point',
    'uses' => 'AdvertiserMypageController@refund_point'
]);
//캠페인 관리
Route::get('advertiser/managecampaign',[
    'as'=>'advertisers.managecampaign',
    'uses' => 'AdvertiserMypageController@manageCampaign'
]);
//모집현황(리뷰어선정)
Route::get('advertiser/managecampaign/recruit_campaign/{campaign}',[
    'as'=>'advertisers.recruit_campaign',
    'uses' => 'AdvertiserMypageController@recruit_campaign'
]);
//리뷰어선정
Route::post('advertiser/managecampaign/select_reviewer/{campaign}',[
    'as'=>'advertisers.select_reviewer',
    'uses' => 'AdvertiserMypageController@select_reviewer'
]);
//리뷰어 선정 해제
//Route::post('advertiser/managecampaign/deselect_reviewer/{campaign}',[
//    'as'=>'advertisers.deselect_reviewer',
//    'uses' => 'AdvertiserMypageController@deselect_reviewer'
//]);
//모집현황에서 리뷰전략 보기
Route::get('show_plan/{reviewer_id}',[
    'uses' => 'AdvertiserMypageController@show_plan'
]);
//리뷰어 정보 다운로드
Route::get('down_reviewer_info/{camId}', 'AdvertiserMypageController@down_reviewer_info')->name('down_reviewer_info');
//진행결과보기
Route::get('advertiser/managecampaign/submit_campaign/{campaign}',[
    'as'=>'advertisers.submit_campaign',
    'uses' => 'AdvertiserMypageController@submit_campaign'
]);
//리뷰어만족도평가
Route::post('advertiser/managecampaign/satisfaction',[
    'as'=>'advertisers.satisfaction',
    'uses' => 'AdvertiserMypageController@satisfaction'
]);
//미제출(신청) 포인트환불
Route::get('advertiser/refund/{campaignId}',[
    'as'=>'advertisers.refund',
    'uses' => 'AdvertiserMypageController@refund'
]);
//캠페인 대행 의뢰
Route::resource('advertiser/agency', 'AgencyController');
//회원정보수정 페이지
Route::get('advertiser/edit_info',[
    'as'=>'advertisers.edit_info',
    'uses' => 'AdvertiserMypageController@edit_info'
]);
//회원정보수정 입력
Route::put('advertiser/update_self/{advertiser}',[
    'as'=>'advertisers.update_self',
    'uses' => 'AdvertiserMypageController@update_self'
]);




//가입 선택화면
Route::view('register_select','register_select')->name('register.select');

///////////////////////////////////
//reviewer **임시** 가입 관련
Route::get('/introduce_service', [
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

Route::post('advertiser/certification',[    
    'as'=>'certification',
    'uses' => 'AdvertisersController@certification'
]);
Route::post('certification',[    
    'as'=>'reviewer.certification',
    'uses' => 'ReviewersController@certification'
]);

//reviewer 가입 관련
Route::get('reviewer/register',[    
    'as'=>'reviewers.create',
    'uses' => 'ReviewersController@create'
]);
Route::post('reviewer/register',[
    'as'=>'reviewers.store',
    'uses' => 'ReviewersController@store'
]);
//reviewers 리소스
Route::resource('reviewers', 'ReviewersController')->except([
    'show'
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
//advertisers 리소스
Route::resource('advertisers', 'AdvertisersController')->except([
    'show'
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
Route::get('reviewer/social_register/{social_email}/{social_name}',[
    'as'=>'reviewers.social_register',
    'uses' => 'SocialController@social_register'
]);
Route::post('reviewer/social_store',[
    'as'=>'reviewers.social_store',
    'uses' => 'ReviewersController@social_store'
]);

/* 가입이메일 찾기 */
Route::get('remind_email', [
    'as' => 'remind_email.create',
    'uses' => 'EmailsController@getRemind',
]);
Route::post('remind_email', [
    'as' => 'remind_email.store',
    'uses' => 'EmailsController@postRemind',
]);

/* 비밀번호 초기화 */
Route::get('remind', [
    'as' => 'remind.create',
    'uses' => 'PasswordsController@getRemind',
]);
Route::post('remind/certification',[    
    'as'=>'remind.certification',
    'uses' => 'PasswordsController@certification'
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

//권한없음 화면
Route::get('admin/no_permission', 'AdminsController@no_permission')->name('admin.no_permission');
//관리자 권한 입력
Route::put('admins/update_authority/{admin}', [
    'as' => 'admins.update_authority',
    'uses' => 'AdminsController@update_authority',
]);
//관리자 리소스
Route::resource('admins', 'AdminsController');

//Route::get('/home', 'HomeController@index')->name('home');

