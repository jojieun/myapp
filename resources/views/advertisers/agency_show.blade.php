@extends('layouts.main')
@section('content')

			@include('advertisers.advertiser_leftmenu')	
                        <!-- 오른쪽 컨텐츠 -->
<div class="right-content">
				<h2>캠페인 대행 의뢰 내역</h2>

				<div class="board_navi_box list">			
					<a href="{{route('agency.index')}}" class="btn_type">목록으로</a>
				</div>
				<!-- 여기부터 게시판 VIEW 테이블폼입니다. -->
				<div class="table_default view">
					<div class="table_td">
						<div class="table_td_line">
							<span class="subject">{{$agency->title}}</span>
							<span class="date w200">{{$agency->created_at}}</span>
						</div>
						<div class="txt_view">
							<div class="txt_view_con">
								{!! nl2br($agency->content) !!}
							</div>
						</div>					
					</div>				
				</div>

				<!-- 진행상황 -->
				<div class="comment2">
                    @if($agency->process)
					<p class="txt">
					{!! nl2br($agency->process) !!}
					</p>
                    @else
                    <p>접수전입니다.</p>
                    @endif
				</div>
				<!-- 진행상황 -->

			</div>				
		</div>
			<!-- //오른쪽 컨텐츠 -->

@include('advertisers.advertiser_leftmenu_tail')
@endsection