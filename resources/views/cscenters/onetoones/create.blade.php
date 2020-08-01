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
				<h2 class="mb70">1:1 문의하기</h2>

				<!-- 여기부터 게시판 글쓰기 테이블폼입니다. -->
				<form action="{{ route('onetoones.store') }}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
					<div class="table_default write">
						<div class="table_td">
							<div class="table_td_line">
								<select name="qcategory_id" id="" class="full_width {{ $errors->has('qcategory_id') ? 'has-error' : '' }}">
                                    <option value="" disabled selected style="display: none;">카테고리를 선택해주세요!</option>
                                    @forelse($qcategories as $qcatetory)
									<option value="{{$qcatetory->id}}">{{$qcatetory->name}}</option>
                                    @empty
									<option value="">카테고리가 없습니다.</option>
                                    @endforelse
								</select>
                                {!! $errors->first('qcategory_id','<span class="red">:message</span>')!!}
							</div>
							<div class="table_td_line  {{ $errors->has('title') ? 'has-error' : '' }}">
								<input name="title" type="text" id="" placeholder="제목을 입력해주세요." class="full_width" value="{{ old('title', $onetoone->title) }}"/>
                                {!! $errors->first('title','<span class="red">:message</span>')!!}
							</div>
							<div class="table_td_line {{ $errors->has('content') ? 'has-error' : '' }}">						
								<textarea name="content" rows="7" id="" placeholder="내용을 입력해주세요." class="full_width" >{{ old('content', $onetoone->content) }}</textarea>
                        {!! $errors->first('content','<span class="red">:message</span>')!!}
							</div>
                            <div class="table_td_line onetoone_image {{ $errors->has('image') ? 'has-error' : '' }} {{ $errors->has('image2') ? 'has-error' : '' }} {{ $errors->has('image3') ? 'has-error' : '' }}">
                                <div class="table_td_title">
                                    첨부<br/>이미지
                                </div>
                                <div class="table_td_in">
								<input name="image" type="file">
                                {!! $errors->first('image','<span class="red">:message</span>')!!}
								<input name="image2" type="file">
                                {!! $errors->first('image2','<span class="red">:message</span>')!!}
								<input name="image3" type="file">
                                {!! $errors->first('image3','<span class="red">:message</span>')!!}
                                </div>
							</div>
						</div>
					</div>

					<div class="board_navi_box write">				
						<a href="{{ route('main' ) }}" class="btn_type btn_border">취소하기</a>
						<button type="submit" class="btn_type">등록하기</button>
					</div>

				</form>
				<!-- 여기까지 게시판 글쓰기 테이블폼입니다. -->

			</div>				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection