@extends('layouts.main')

@section('content')
	<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
		<!-- //탭-->
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
			<!-- 왼쪽메뉴 -->
			@include('cscenters.leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2>공지사항</h2>

				<div class="board_navi_box list">				
                    <span class="search"><form method="get" action="{{route('notice.search')}}" class="in_search_form"><input name="in_search_word" type="text" placeholder="검색어를 입력해주세요" ><button type="submit"><img src="/img/common/ico_search.gif" alt="검색" /></button></form></span>
				</div>
				<!-- 여기부터 게시판 목록 테이블폼입니다. -->
				<form>
					<div  class="table_default notice">
						<div class="table_th">
							<p class="list_num">번호</p>
							<p class="list_subj">제목</p>
							<p class="list_date">등록일</p>
						</div>
                        @forelse($notices as $notice)
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_num">{{ $loop->iteration }}</p>
								<p class="list_subj"><a href="{{route('notices.show', $notice->id)}}"><span>{{$notice->title}}</span></a></p>
								<p class="list_date">{{$notice->created_at}}</p>
							</div>
						</div>
                        @empty
                        <div class="table_td">
                            <div class="table_td_line">
                            공지사항이 없습니다.
                            </div>
                        </div>
                        @endforelse
					</div>	
				</form>

							<!-- 페이지 위치, 글쓰기 -->
@if($notices->count())
        <div class="text-center paginator__article">
          {!! $notices->render() !!}
        </div>
        @endif
			<!-- //페이지 위치, 글쓰기 -->
				<!-- 여기까지 게시판 테이블폼입니다. -->
			</div>				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
<script>
$('.in_search_form').submit(function(){
    if($('input[name=in_search_word]').val()){
        return true;
    }else{
        alert('검색어를 입력해주세요');
        return false;
    }
})
</script>
@endsection
