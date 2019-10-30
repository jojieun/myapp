@extends('layouts.main')
@section('content')

			@include('advertisers.advertiser_leftmenu')	
                       <!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2 class="mb30">캠페인 관리</h2>
				<!-- 탭 -->
				<ul class="campaign-tab">
					<li class="on"><a href="#waitCampaigns"><span class="num">1</span><span class="title">검수중</span></a></li>
					<li><a href="#recruitCampaigns"><span class="num">2</span><span class="title">리뷰어선정<br/>대기중</span></a></li>
					<li><a href="#submitCampaigns"><span class="num">3</span><span class="title">진행중</span></a></li>
					<li><a href="#endCampaigns"><span class="num">4</span><span class="title">완료</span></a></li>
				</ul>
				<!-- 탭 -->
<!--            검수중 캠페인-->
				<div class="campaign-list-view" id="waitCampaigns">
                    <?
                    $campaigns = $waitCampaigns;
                    $modi = 1;
                    $select = 0;
                    $result = 0;
                    $which = '검수중인';
                    ?>
				    @include('advertisers.particle_managecampaign')
                </div>
<!--                --------검수중 캠페인 끝-->
<!--                리뷰어 선정 대기중 캠페인-->
                <div class="campaign-list-view" id="recruitCampaigns">
                    <?
                    $campaigns = $recruitCampaigns;
                    $modi = 0;
                    $select = 1;
                    $result = 0;
                    $which = '리뷰어선정 대기중인';
                    ?>
				    @include('advertisers.particle_managecampaign')
                </div>
<!--                --------리뷰어 선정 대기중 캠페인 끝-->
<!--                진행중 캠페인-->
                <div class="campaign-list-view" id="submitCampaigns">
                    <?
                    $campaigns = $submitCampaigns;
                    $modi = 0;
                    $select = 0;
                    $result = 1;
                    $which = '진행중인';
                    ?>
				    @include('advertisers.particle_managecampaign')
                </div>
<!--                --------진행중 캠페인 끝-->
<!--                완료 캠페인-->
                <div class="campaign-list-view" id="endCampaigns">
                    <?
                    $campaigns = $endCampaigns;
                    $modi = 0;
                    $select = 0;
                    $result = 1;
                    $which = '완료된';
                    ?>
				    @include('advertisers.particle_managecampaign')
                </div>
<!--                --------완료 캠페인 끝-->
                <script>
//                    캠페인 탭 바꾸기
                    changeTab();
                    $(window).on('hashchange', function(e){
                        changeTab();
                    });
                    function changeTab(){
                        var nowHash = window.location.hash;
                        $('.campaign-tab li').removeClass('on');
                        if(nowHash=='#waitCampaigns'){
                            $('.campaign-tab li').eq(0).addClass('on');
                        }else if(nowHash=='#recruitCampaigns'){
                            $('.campaign-tab li').eq(1).addClass('on');
                        }else if(nowHash=='#submitCampaigns'){
                            $('.campaign-tab li').eq(2).addClass('on');
                        }else {
                            $('.campaign-tab li').eq(3).addClass('on');
                        }
                    }
                </script>
@include('advertisers.advertiser_leftmenu_tail')
@endsection