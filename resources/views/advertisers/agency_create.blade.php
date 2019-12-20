@extends('layouts.main')
@section('content')

			@include('advertisers.advertiser_leftmenu')	
                        <!-- 오른쪽 컨텐츠 -->
<div class="right-content">
				<h2>캠페인 대행 의뢰 하기</h2>

				<!-- 여기부터 게시판 글쓰기 테이블폼입니다. -->
				<form action="{{ route('agency.store') }}" method="post">
                    {!! csrf_field() !!}
					<div class="table_default write">
						<div class="table_td">
							<div class="table_td_line  {{ $errors->has('title') ? 'has-error' : '' }}">
								<input name="title" type="text" id="" placeholder="의뢰 제목을 입력해주세요." class="full_width" value="{{ old('title', $agency->title) }}"/>
                                {!! $errors->first('title','<span class="red">:message</span>')!!}
							</div>
							<div class="table_td_line {{ $errors->has('content') ? 'has-error' : '' }}">						
								<textarea name="content" rows="7" id="" placeholder="의뢰 내용을 입력해주세요." class="full_width" >{{ old('content', $agency->content) }}</textarea>
                        {!! $errors->first('content','<span class="red">:message</span>')!!}
							</div>
						</div>
					</div>

					<div class="board_navi_box write">				
						<a href="{{ route('agency.index' ) }}" class="btn_type btn_border">취소하기</a>
						<button type="submit" class="btn_type">등록하기</button>
					</div>

				</form>
				<!-- 여기까지 게시판 글쓰기 테이블폼입니다. -->

			</div>				
		</div>
			<!-- //오른쪽 컨텐츠 -->

@include('advertisers.advertiser_leftmenu_tail')
@endsection