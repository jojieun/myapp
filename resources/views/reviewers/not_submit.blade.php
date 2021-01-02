@extends('layouts.main')
@section('content')
<!-- 왼쪽메뉴 -->
@include('reviewers.reviewer_leftmenu')
<!-- 오른쪽 컨텐츠 -->
<div class="right-content">
    <h2 class="mb70 m-text-left">미제출 리뷰</h2>
    <!--  미제출리뷰캠페인-->
    <div class="my-reviewer bt2">
        <ul>
            @if($end_notSubmitCampaigns->count()<1 && $notSubmitCampaigns->count()<1)
                미제출 리뷰가 없습니다.
            @else
                <? $option = 'end'; //마감 후 미제출리뷰캠페인 표시  ?>
                @foreach($end_notSubmitCampaigns as $campaign)
                    @include('reviewers.particle_mycampaign')
                @endforeach
                <? $option = 'select'; //미제출리뷰캠페인 표시  ?>
                @foreach($notSubmitCampaigns as $campaign)
                    @include('reviewers.particle_mycampaign')
                @endforeach
            @endif
        </ul>
    </div>
</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('reviewers.reviewer_bottommenu')
@include('reviewers.mycampaign_script')
@endsection