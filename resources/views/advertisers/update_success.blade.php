@extends('layouts.main')
@section('content')

			@include('advertisers.advertiser_leftmenu')	
                        <!-- 오른쪽 컨텐츠 -->
<div class="right-content">
				<h2 class="mb70 m-text-left">회원정보수정이 완료되었습니다.</h2>		

				<div class="table_form2">
					<dl>
						<dt>이메일</dt>
						<dd class="lh40">{{$user->email}}</dd>
					</dl>
					<dl>
						<dt>이름</dt>
						<dd class="lh40">{{$user->name}}</dd>
					</dl>
					<dl>
						<dt>휴대폰번호</dt>
						<dd class="lh40">{{$user->mobile_num}}</dd>
					</dl>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap">
					<a a href="{{ route('advertisers.edit_info') }}" class="btn">회원정보 재수정</a>
					<a a href="{{ route('advertisers.mypage') }}" class="btn black">마이페이지 메인으로</a>
				</div>
			</div>
		</div>
			<!-- //오른쪽 컨텐츠 -->

@include('advertisers.advertiser_leftmenu_tail')	
@endsection