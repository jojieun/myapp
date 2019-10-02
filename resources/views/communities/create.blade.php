@extends('layouts.main')
@section('content')
<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
			
			<h2>커뮤니티</h2>

		<!-- 여기부터 게시판 글쓰기 테이블폼입니다. -->
		<form action="{{ route('communities.store') }}" method="post">
            {!! csrf_field() !!}
			@include('communities.partial.form')
<div class="board_navi_box write">				
				<a href="{{ route('communities.index' ) }}" class="btn_type btn_border">취소하기</a>
				<button type="submit" class="btn_type">등록하기</button>
			</div>
		</form>
		<!-- 여기까지 게시판 글쓰기 테이블폼입니다. -->
				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection