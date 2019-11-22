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
				<h2>문의내역</h2>

				<div class="board_navi_box list">			
					<a href="{{route('onetoones.index')}}" class="btn_type">목록으로</a>
				</div>
				<!-- 여기부터 게시판 VIEW 테이블폼입니다. -->
				<div class="table_default view">
					<div class="table_td">
						<div class="table_td_line">
							<span class="subject">{{$onetoone->title}}</span>
							<span class="date w200">{{$onetoone->created_at}}</span>
						</div>
						<div class="txt_view">
							<div class="txt_view_con">
								{!! nl2br($onetoone->content) !!}
							</div>
						</div>					
					</div>				
				</div>

				<!-- 답변 -->
				<div class="comment2">
                    @if($onetoone->answer)
					<p class="title">{{$onetoone->answer_title}}</p>
					<p class="date">{{$onetoone->updated_at}}</p>
					<p class="txt">
					{!! nl2br($onetoone->answer) !!}
					</p>
                    @else
                    <p>답변 준비중입니다. 조금만 기다려주세요!</p>
                    @endif
				</div>
				<!-- 답변 -->

			</div>				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection