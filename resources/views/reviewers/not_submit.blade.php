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
                window.location.hash ='#close';
            window.location.reload();
            }
        });
        
    });
</script>

@endsection