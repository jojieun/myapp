@extends('layouts.main')
@section('content')
<div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 -->	
		<div class="content-in-sub member mtb150 text-center">
			<h2>
				<b>{{ $name }}님 가입을 축하드립니다!</b>
				<p>{{ config('app.name') }}에서 리뷰어를 직접 모집하세요:) </p>
			</h2>

			<div class="login-group">				
				<a href="{{route('radvertisers.mypage')}}" class="btn big w50">마이페이지</a>
				<a href="{{route('campaigns.create')}}" class="btn black big w50">캠페인 등록</a>
			</div>

		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection