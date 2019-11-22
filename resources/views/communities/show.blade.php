@extends('layouts.main')
@section('content')
<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
			
			<h2>커뮤니티</h2>

			<div class="board_navi_box list">			
				<a href="{{ route('communities.index') }}" class="btn_type">목록으로</a>
			</div>
			<!-- 여기부터 게시판 VIEW 테이블폼입니다. -->
			<div class="table_default view" id="has_id" data-id="{{ $community->id }}">
				<div class="table_td">
					
					<div class="table_td_line">
						<span class="subject">{{$community->title}}</span>
						<span class="date w200"> @if($community->reviewer)
                                {{$community->reviewer->nickname}}
                                @else
                                {{$community->advertiser->name}}
                                @endif  ｜  {{$community->updated_at}}  ｜  {{$community->view_count}}</span>
					</div>
					<div class="txt_view">
						<div class="txt_view_con">
							{{$community->content}}
						</div>
					</div>					
						
				</div>				
			</div>
			
			<div class="board_navi_box view">
                @if((Auth::guard('advertiser')->check() && (auth()->guard('advertiser')->user()->id==$community->advertiser_id)) || (Auth::guard('web')->check() && (auth()->guard('web')->user()->id==$community->reviewer_id)) )

				<a href="{{ route('communities.edit', $community->id) }}" class="btn_type btn_border">수정</a>
				<a class="btn_type btn_border button__delete">삭제</a>

                @endif
			</div>

			<!-- 댓글 -->
			<div class="comment">
				<h3>댓글</h3>
				<p class="comment-input">
					<textarea name="" id="" cols="30" rows="10" placeholder="댓글을 등록해 주세요" class="border"></textarea>
					<a href="#">등록</a>
				</p>
				<ul class="comment-list">
					<li>
						<span class="comment-id">
							<p>테크토니</p>
							<span>2019-07-10 11:50</span>
						</span>
						<span class="comment-txt">감사합니다!! 도움이 되었어요! 감사합니다!! 도움이 되었어요! 감사합니다!! 도움이 되었어요! 감사합니다!! 도움이 되었어요! 감사합니다!! 도움이 되었어요! 감사합니다!! 도움이 되었어요!</span>
					</li>
					<li>
						<span class="comment-id">
							<p>테크토니</p>
							<span>2019-07-10 11:50</span>
						</span>
						<span class="comment-txt">감사합니다!! 도움이 되었어요!</span>
					</li>
					<li>
						<span class="comment-id">
							<p>테크토니</p>
							<span>2019-07-10 11:50</span>
						</span>
						<span class="comment-txt">감사합니다!! 도움이 되었어요!</span>
					</li>
				</ul>
			</div>
			<!-- 댓글 -->
			<!-- 여기까지 게시판 VIEW 테이블폼입니다. -->
				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>

<!--script-->
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    $('.button__delete').on('click', function(e){
       var communityId = $('#has_id').data('id');

      if (confirm('글을 삭제합니다.')) {
        $.ajax({
          type: 'DELETE',
          url: '/communities/' + communityId,
        }).then(function () {
          window.location.href = '/communities';
        });
      }
    });
</script>
@endsection