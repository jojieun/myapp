@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2 class="m-text-left">나의 캠페인</h2>
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
@include('reviewers.make_review')
<!--리뷰수정-->
@include('reviewers.edit_review')
<script>
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
</script>
@endsection