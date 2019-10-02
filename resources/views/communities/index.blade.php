@extends('layouts.main')
@section('content')
<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
		<!-- //탭-->
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">

			<h2>커뮤니티</h2>
			
			<div class="board_navi_box list">				
				<span class="search"><input name="" type="text" placeholder="검색어를 입력해주세요"><a href="#"><img src="/img/common/ico_search.gif" alt="검색"></a></span>
				<a href="{{ route('communities.create') }}" class="btn_type">글쓰기</a>
			</div>
			<!-- 여기부터 게시판 목록 테이블폼입니다. -->
			<form>
				<div  class="table_default">
					<div class="table_th">
						<p class="list_subj">제목</p>
						<p class="list_writer">작성자</p>
						<p class="list_date">작성일</p>
						<p class="list_count">조회수</p>
					</div>
                   
					<div class="table_td">
                         @forelse($communities as $community)
						  @include('communities.partial.community', compact('community'))
						@empty
						<div class="table_td_line">
                            글이 없습니다.
						</div>
                        @endforelse
					</div>
				</div>	
			</form>
            

			<!-- 페이지 위치, 글쓰기 -->
			@if($communities->count())
        <div class="text-center paginator__article">
          {!! $communities->render() !!}
        </div>
      @endif
			<!-- //페이지 위치, 글쓰기 -->
			<!-- 여기까지 게시판 테이블폼입니다. -->
				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection