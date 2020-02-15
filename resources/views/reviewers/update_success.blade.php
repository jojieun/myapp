@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
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
						<dt>닉네임</dt>
						<dd class="lh40">{{$user->nickname}}</dd>
					</dl>
                    <dl>
						<dt>생년월일</dt>
						<dd class="lh40">{{$user->birth}}</dd>
					</dl>
					<dl>
						<dt>휴대폰번호</dt>
						<dd class="lh40">{{$user->mobile_num}}</dd>
					</dl>
                    <dl>
						<dt>주소</dt>
						<dd class="lh40">[{{$user->zipcode}}] {{$user->address}} {{$user->detail_address}}</dd>
					</dl>
                    <dl>
						<dt>성별</dt>
						<dd class="lh40">
                            @if($user->gender=='f')
                            여자
                            @else
                            남자
                            @endif</dd>
					</dl>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap">
					<a a href="{{ route('reviewers.edit_info') }}" class="btn">회원정보 재수정</a>
					<a a href="{{ route('reviewers.mypage') }}" class="btn black">마이페이지 메인으로</a>
				</div>
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('reviewers.reviewer_bottommenu')
@endsection