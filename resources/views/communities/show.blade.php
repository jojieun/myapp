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
						<span class="date w360"> @if($community->reviewer)
                                {{$community->reviewer->nickname}}
                                @else
                                {{$community->advertiser->name}}
                                @endif  ｜  {{$community->created_at}}  ｜  {{$community->view_count}}</span>
					</div>
					<div class="txt_view">
						<div class="txt_view_con">
							{!!nl2br($community->content)!!}
						</div>
					</div>					
						
				</div>				
			</div>
			
			<div class="board_navi_box view">
                @if((Auth::guard('advertiser')->check() && (auth()->guard('advertiser')->user()->id==$community->advertiser_id)) || (Auth::guard('web')->check() && (auth()->guard('web')->user()->id==$community->reviewer_id)) || Auth::guard('admin')->check() )

				<a href="{{ route('communities.edit', $community->id) }}" class="btn_type btn_border">수정</a>
				<a class="btn_type btn_border button__delete">삭제</a>

                @endif
			</div>

			<!-- 댓글 -->
			<div class="comment">
				<h3>댓글</h3>
				<p class="comment-input">
					<textarea name="ccontent" id="ccontent" cols="30" rows="10" @if( Auth::guard('web')->check() || Auth::guard('advertiser')->check() ) placeholder="댓글을 등록해 주세요" @else placeholder="로그인하시면 댓글을 달 수 있습니다" disabled @endif class="border"></textarea>
					<a href="" id="make_b">등록</a>
				</p>
				<ul class="comment-list">
                    <?$comments=$community->comments;?>
                    @include('communities.comments')
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
    //댓글작성
    $('#make_b').on('click', function(e){
       e.preventDefault();
        
        var con = $('#ccontent').val();
        $('#ccontent').val('');
        if(con){
        $.ajax({
           type:"POST",
           url:'{{route('makecomment')}}',
            data:{
                'content':con,
            'community_id':{{$community->id}}
            },
            success: function(data){
                $('.comment-list').html(data.finhtml);
            }
        });
        }
        
    });
    //글 삭제
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
    //댓글 삭제
    $('.comment_del').on('click', function(e){
       var commentId = $(this).data('id');
var communityId = $('#has_id').data('id');
      if (confirm('댓글을 삭제합니다.')) {
        $.ajax({
          type: 'POST',
          url: '/delcomment/' + commentId,
            data:{
            'community_id':communityId
            },
            success: function(data){
                $('.comment-list').html(data.finhtml);
            }
        });
      }
    });
</script>
@endsection