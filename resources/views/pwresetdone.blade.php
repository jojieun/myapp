@extends('layouts.main')

@section('content')
<div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 -->	
		<div class="content-in-sub member mtb150 text-center">
			<h2>
				<b>비밀번호 변경이 완료되었습니다!</b>
			</h2>

			<div class="login-group">				
				<a href="{{route('main')}}" class="btn big w50">메인으로</a>
				<a href="{{route('sessions.create')}}" class="btn black big w50">로그인페이지</a>
			</div>

		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection