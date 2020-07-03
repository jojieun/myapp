@extends('layouts.main')

@section('content')
	<div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 -->	
		<div class="content-in-sub member">
			<h2>
				<b>가입 이메일 찾기 결과</b>
				<p class="mtb30">{{$name}} 회원님의 가입 이메일은<br/><b>{{$email}}</b> 입니다.</p>
			</h2>

			<div class="login-group">
                @if($kind=='reviewer')
				<a href="{{ route('sessions.create') }}" class="btn black big w50">로그인하기</a>
                @else
                <a href="{{ route('advertiser_sessions.create') }}" class="btn black big w50">로그인하기</a>
                @endif
				<a href="{{ route('remind.create') }}" class="btn big w50">비밀번호찾기</a>
			</div>

		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection