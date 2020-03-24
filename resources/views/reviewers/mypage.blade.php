@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<div class="my-reviewer-top">
					<dl>
						<dt><b>나의포인트</b><a href="{{route('reviewers.point')}}">자세히보기</a></dt>
						<dd><b>{{ number_format($user->point) }}</b>P</dd>
					</dl>
					<ul>
						<li>
                            <a href="{{route('reviewers.not_submit')}}">
                            <span class="title">미제출리뷰</span><span class="txt"><b>{{$notreview}}</b><em>건</em></span>
                            </a>
                        </li>
						<li>
                            <a href="{{route('reviewers.suggestion')}}">
                            <span class="title">리뷰제안</span><span class="txt"><b>{{$suggestions}}</b><em>건</em></span></a></li>
<!--
						<li>
                            <a href="{{route('reviewers.plan_reading')}}">
                            <span class="title">리뷰전략열람</span><span class="txt"><b>{{$advertiserPlans}}</b><em>건</em></span></a></li>
-->
						<li>
                            <a href="{{route('reviewers.bookmark_list')}}">
                            <span class="title">관심캠페인</span><span class="txt"><b>{{$bookmarks}}</b><em>건</em></span></a></li>
					</ul>
				</div>
                @if(!$user->plan_count)
				<p class="login-info2">
					<span class="txt">리뷰전략 등록으로 캠페인 리뷰어로 신청해보세요!</span>
					<a href="{{route('plans.create')}}" class="btn h46 fl-r">리뷰전략등록</a>
				</p>
				@endif
				<!-- 캠페인 리스트 -->
				<div>
					<!-- 탭 -->
					<ul class="mypage-tab">
						<li><a href="#apply" class="on">신청캠페인</a></li>
						<li><a href="#select">선정캠페인</a></li>
						<li><a href="#end">종료캠페인</a></li>
					</ul>
					<!-- //탭 -->
<!--                    신청캠페인-->
					<div class="my-reviewer" id="apply">
						<ul>
                            <? $option = 'apply'; //신청캠페인  ?>
                            @forelse($applyCampaigns as $campaign)
                                @include('reviewers.particle_mycampaign')
                            @empty
                                모집중인 신청캠페인이 없습니다
                            @endforelse
						</ul>
					</div>
<!--                    선정캠페인-->
                    <div class="my-reviewer" id="select">
						<ul>
                            <? $option = 'select'; //선정캠페인 표시  ?>
                            @forelse($selectCampaigns as $campaign)
                                @include('reviewers.particle_mycampaign')
                            @empty
                                선정된 캠페인이 없습니다
                            @endforelse
						</ul>
					</div>
<!--                    종료캠페인-->
                    <div class="my-reviewer" id="end">
						<ul>
                            <? $option = 'end'; //종료캠페인 표시  ?>
                            @forelse($endCampaigns as $campaign)
                                @include('reviewers.particle_mycampaign')
                            @empty
                                종료된 참여 캠페인이 없습니다
                            @endforelse
						</ul>
					</div>
				</div>				
				<!-- //캠페인 리스트 -->
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('reviewers.reviewer_bottommenu')
<!--리뷰작성-->
<a href="#" class="overlay" id="popup_reviewer"></a>
        <div class="popup term">
			<div class="text3">
				<h3>리뷰 URL</h3>
				<p><input name="url" type="text" id="" value="" placeholder="리뷰 URL을 입력해주세요." class="full_width" /></p>
				<h3>캠페인 참여 후기</h3>
				<p><textarea name="after" id="" cols="1" rows="5" placeholder="광고주에게 전달할 캠페인 참여후기를 입력해주세요." class="border2"></textarea></p>
				<a class="btn black h46" id="submission">제출</a>
			</div>
            <a class="close" href="#select"></a>
        </div>
<!--리뷰수정-->
<a href="#close" class="overlay" id="edit_review"></a>
<div class="popup term" id="edit_r">
    
</div>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    var nowCam;
    $('.my-reviewer').on('click','.submission', function(){
       nowCam = $(this).data('c');
    });
    //리뷰제출 창에서 제출 클릭시
    $('#submission').on('click', function(e){
       e.preventDefault();
        $.ajax({
           type:"POST",
           url:"{{route('reviewers.create_review')}}",
            data:{
            'campaign_id':nowCam,
                'url':$('input[name=url]').val(),
                'after':$('textarea[name=after]').val(),
            },
            success: function(){
                window.location.hash ='#select';
            window.location.reload();
            }
        });
        
    });
    
        //리뷰수정 클릭시
$('.edit_review').on('click', function(e){
//       e.preventDefault();
    var nowId = $(this).data('r');
        $.ajax({
           type:"get",
           url:'edit_review/' + nowId,
            success: function(data){
                $('#edit_r').html(data.showhtml)
                window.location.hash = '#edit_review'; 
            }
        });
        
    });
    // 수정입력 클릭시
    $('#edit_r').on('click','#modal_submit', function(e){
       e.preventDefault();
    var nowId = $(this).data('id');
        $.ajax({
           type:"put",
           url:'update_review/' + nowId,
            data:{
                'url':$('#answer input[name=url]').val(),
                'after':$('#answer textarea[name=after]').val(),
            },
            success: function(data){
                window.location.hash = '#select'; 
            }
        });
        
    });
    
//                    캠페인 탭 바꾸기
    window.location.hash='#apply';
    changeTab();
    $(window).on('hashchange', function(e){
        changeTab();
    });
    function changeTab(){
        var nowHash = window.location.hash;
        $('.mypage-tab li a').removeClass('on');
        if(nowHash=='#apply'){
            $('.mypage-tab li a').eq(0).addClass('on');
        }else if(nowHash=='#select'){
            $('.mypage-tab li a').eq(1).addClass('on');
        }else if(nowHash=='#end'){
            $('.mypage-tab li a').eq(2).addClass('on');
        }
    }
//    리뷰제출
</script>

@endsection