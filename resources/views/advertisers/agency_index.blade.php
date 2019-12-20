@extends('layouts.main')
@section('content')

			@include('advertisers.advertiser_leftmenu')	
                        <!-- 오른쪽 컨텐츠 -->
<div class="right-content">
				<h2>캠페인 대행 의뢰 내역</h2>

				<div class="board_navi_box list">
					<a href="{{route('agency.create')}}" class="btn_type">의뢰하기</a>
				</div>
				<!-- 여기부터 게시판 목록 테이블폼입니다. -->
					<div  class="table_default ask">
						<div class="table_th">
							<p class="list_subj">의뢰제목</p>
							<p class="list_date">의뢰날짜</p>
							<p class="list_comment">접수여부</p>
						</div>
                        @forelse($agencies as $agency)
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_subj"><a href="{{route('agency.show', $agency->id)}}">{{$agency->title}}</a></p>
								<p class="list_date">{{$agency->created_at}}</p>
								<p class="list_comment">
                                    <a>
                                    @if(isset($agency->process))
                                    <span class="btn_comment yes">접수완료</span>
                                    @else
                                    <span class="btn_comment">접수전</span>
                                    @endif
                                    </a>
                                    </p>
							</div>
						</div>
                        @empty
						<div class="table_td">
							<p class="txt-none">의뢰하신 내역이 없습니다.</p>
                        </div>
                        @endforelse
					</div>	

			</div>				
		</div>
			<!-- //오른쪽 컨텐츠 -->

@include('advertisers.advertiser_leftmenu_tail')
@endsection