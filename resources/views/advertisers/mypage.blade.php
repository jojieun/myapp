@extends('layouts.main')
@section('content')

@include('advertisers.advertiser_leftmenu')
<!-- 오른쪽 컨텐츠 -->
<div class="right-content">

    <p class="my-btn">
        <span><a href="{{ route('campaigns.create') }}" class="btn w50">새 캠페인 등록하기</a></span>
        <span><a href="{{ route('agency.create') }}" class="btn w50 fl-r">캠페인 대행 의뢰하기</a></span>
    </p>

    <div class="my-campaign">
        <div class="title">
            <h2>진행중인 캠페인</h2>
            <a href="{{ route('advertisers.managecampaign').'#waitCampaigns' }}" class="btn black">캠페인관리</a>
        </div>
        <!-- 검수중 -->
        <div class="my-campaign-in">
            <b>검수중 <span>{{$waitCampaigns->count()}}</span></b>
            <div class="campaign-banner" align="center">
                @forelse ($waitCampaigns as $waitCampaign)
                <div>
                    <a href="{{ route('advertisers.managecampaign').'#waitCampaigns' }}">
                        <b class="txt01">{{$waitCampaign->name}}</b>
                    </a>
                </div>
                @empty
                <div>
                    <a href="#">
                        <b class="txt01">검수중인 캠페인이 없습니다</b>
                    </a>
                </div>
                @endforelse
            </div>
        </div>
        <!-- //검수중 -->
        <!-- 리뷰어 모집중 -->
        <div class="my-campaign-in">
            <b>리뷰어 모집(선정대기)중 <span>{{$recruitCampaigns->count()}}</span></b>
            <div class="campaign-banner" align="center">
                @forelse ($recruitCampaigns as $recruitCampaign)
                <div>
                    <a href="{{ route('advertisers.managecampaign').'#recruitCampaigns' }}">
                        <b class="txt02">{{ $recruitCampaign->name }}</b>
                        <p class="txt03">모집현황 <span>{{ $recruitCampaign->campaignReviewers->count() }}</span> / {{ $recruitCampaign->recruit_number }}</p>
                    </a>
                </div>
                @empty
                <div>
                    <a href="#">
                        <b class="txt01">리뷰어 모집중인 캠페인이 없습니다</b>
                    </a>
                </div>
                @endforelse
            </div>
        </div>
        <!-- //리뷰어 선정대기중 -->
        <!-- 진행중 -->
        <div class="my-campaign-in">
            <b>진행중 <span>{{$submitCampaigns->count()}}</span></b>
            <div class="campaign-banner" align="center">
                @forelse ($submitCampaigns as $submitCampaign)
                <div>
                    <a href="{{ route('advertisers.managecampaign').'#submitCampaigns' }}">
                        <b class="txt02">{{ $submitCampaign->name }}</b>
                        <p class="txt03">제출현황 <span>{{ $submitCampaign->reviews_count }}</span> / {{ $submitCampaign->campaignReviewers->count() }}</p>
                    </a>
                </div>
                @empty
                <div>
                    <a href="#">
                        <b class="txt01">진행중인 캠페인이 없습니다</b>
                    </a>
                </div>
                @endforelse
            </div>
        </div>
        <!-- //진행중 -->
        <!-- 완료 -->
        <div class="my-campaign-in">
            <b>완료 <span>{{$endCampaigns->count()}}</span></b>
            <div class="campaign-banner" align="center">
                @forelse ($endCampaigns as $endCampaign)
                <div>
                    <a href="{{ route('advertisers.managecampaign').'#endCampaigns' }}">
                        <b class="txt01">{{$endCampaign->name}}</b>
                    </a>
                </div>
                @empty
                <div>
                    <a href="#">
                        <b class="txt01">완료된 캠페인이 없습니다</b>
                    </a>
                </div>
                @endforelse
            </div>
        </div>
        <!-- //완료 -->
    </div>

    <p class="my-btn-bottom">
        <span><a href="{{ route('influencers.index') }}">인플루언서 검색</a></span>
        <span><a href="{{ route('advertisers.edit_info') }}">회원정보수정</a></span>
    </p>
    <p class="my-btn-bottom">
        <span><button class="btn w50" id="show_point"><b>보유포인트</b> : <b>{{ number_format($user->point) }}</b>P</button></span>
    </p>
</div>
<!-- //오른쪽 컨텐츠 -->
<!-- popup : 포인트리스트 불러오기 -->
        <a href="#" class="overlay" id="point_list"></a>
        <div class="popup h350">
            <div id="refund_point">
            </div>
        <a class="close" href="#close"></a>
        </div>
		<!-- //popup : 포인트리스트불러오기 -->
@include('advertisers.advertiser_leftmenu_tail')
<script type="text/javascript">
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    $('.campaign-banner').slick({
        infinite: true,
        arrows: true
    });
    $('#show_point').click(function(){
        $.ajax({
           type:"get",
           url:"{{ route('advertiser.refund_point') }}",
           success:function(data){
                   $('#refund_point').html(data.showhtml);
                   window.location.hash = '#point_list';
           },
            error: function(data) {
                alert('포인트리스트 불러오기에 문제가 있습니다.');
               }
        });
    });
</script>
@endsection