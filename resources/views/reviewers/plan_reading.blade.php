@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
                <h2 class="mb70 m-text-left">리뷰전략 열람 정보</h2>

				<!-- 리뷰전략 열람 정보 -->
				<div  class="table_default review-info">
					<div class="table_th">
						<p class="list_company">회사명</p>
						<p class="list_ing">진행중 캠페인</p>
						<p class="list_date">열람일</p>
					</div>
                    @forelse($advertiserPlans as $advertiserPlan)
					<div class="table_td">
						<div class="table_td_line">
							<p class="list_company">{{$advertiserPlan->advertiser->name}}</p>
							<p class="list_ing"><a href="#show_campaign" class="show_campaign" data-a="{{$advertiserPlan->advertiser_id}}">리뷰어 모집중 <span>{{$advertiserPlan->campaigns_count}}</span>개</a></p>
							<p class="list_date">{{$advertiserPlan->updated_at}}</p>
						</div>
					</div>
                    @empty
                    <div class="table_td">
						<div class="table_td_line">
                            열람 내역이 없습니다.
						</div>
					</div>
                    @endforelse
				</div>
				<!-- //리뷰전략 열람 정보 -->
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('reviewers.reviewer_bottommenu')
<!--리뷰수정-->
<a href="#close" class="overlay" id="show_campaign"></a>
<div class="popup campaign23" id="show_campaigns">
    
</div>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
        //리뷰어모집중 클릭시
$('.show_campaign').on('click', function(e){
       e.preventDefault();
    var adId = $(this).data('a');
        $.ajax({
           type:"get",
           url:'show_campaign/' + adId,
            success: function(data){
                $('#show_campaigns').html(data.showhtml);
                window.location.hash = '#show_campaign'; 
            }
        });
        
    });

</script>

@endsection