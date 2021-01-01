@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2 class="mb70 m-text-left">미제출 리뷰</h2>

<!--                    미제출리뷰캠페인-->
                    <div class="my-reviewer bt2">
						<ul>
                            <? $option = 'select'; //미제출리뷰캠페인 표시  ?>
                            @forelse($notSubmitCampaigns as $campaign)
                                @include('reviewers.particle_mycampaign')
                            @empty
                                미제출 리뷰가 없습니다
                            @endforelse
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