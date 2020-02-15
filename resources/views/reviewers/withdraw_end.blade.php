@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
                <div class="step4 text-center">
					<p class="title"><b>출금신청이 완료되었습니다.</b>신청내용 검수 후 입금됩니다.</p>
                    <br/>
					<div class="login-group">				
						<a href="{{ route('main') }}" class="btn big w50">메인으로</a>
						<a href="{{ route('reviewers.mypage') }}" class="btn black big w50">마이페이지로</a>
					</div>
				</div>
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('reviewers.reviewer_bottommenu')
@endsection