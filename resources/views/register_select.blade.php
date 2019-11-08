@extends('layouts.main')

@section('content')

	<div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 -->	
		<div class="content-in-sub member">
			<h2 class="m-text-left">
				<b>회원가입</b>
				<p>{{ config('app.name') }}에서 다양한 체험을 경험해보세요:)</p>
			</h2>		

			<div class="join-btn01">
				<a href="{{route('reviewers.create')}}">리뷰어<span>(개인회원)</span></a>
				<a href="{{route('advertisers.create')}}">광고주<span>(기업회원)</span></a>
			</div>

			<div class="sns-login">
				<b>리뷰어(개인) SNS 가입</b>
				<p>리뷰어(개인) 가입을 희망하시는 분들은 SNS계정으로 회원가입을 하실 수 있습니다.</p>
				<ul>
					<li><a href="#">네이버 회원가입</a></li>
					<li><a href="#">인스타그램 회원가입</a></li>
					<li><a href="#">카카오 회원가입</a></li>
					<li><a href="#">구글 회원가입</a></li>
				</ul>
			</div>	

		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>

@endsection