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
					<a href="{{route('onetoones.create')}}" class="btn_type">1:1 문의하기</a>
				</div>
				<!-- 여기부터 게시판 목록 테이블폼입니다. -->
					<div  class="table_default ask">
						<div class="table_th">
							<p class="list_subj">문의제목</p>
							<p class="list_date">문의날짜</p>
							<p class="list_comment">답변여부</p>
						</div>
                        @forelse($onetoones as $onetoone)
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_subj"><a href="{{route('onetoones.show', $onetoone->id)}}">{{$onetoone->title}}</a></p>
								<p class="list_date">{{$onetoone->created_at}}</p>
								<p class="list_comment"><a href="{{route('onetoones.show', $onetoone->id)}}">
                                    @if(isset($onetoone->answer))
                                    <span class="btn_comment yes">답변완료</span>
                                    @else
                                    <span class="btn_comment">미답변</span>
                                    @endif
                                    </a></p>
							</div>
						</div>
                        @empty
						<div class="table_td">
							<p class="txt-none">문의하신 내역이 없습니다.</p>
                        </div>
                        @endforelse
					</div>	


				<!-- //페이지 위치, 글쓰기 -->
                @if($onetoones->count())
        <div class="text-center paginator__article">
          {!! $onetoones->render() !!}
        </div>
                @endif
				<!-- 여기까지 게시판 테이블폼입니다. -->

			</div>				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection