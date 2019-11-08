@extends('layouts.temp_main')
@section('content')
<div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 -->	
		<div class="content-in-sub member mtb150 text-center">
			<h2>
				<b>{{ $name }}님 리뷰전략 작성이 완료되었습니다.</b>
				<p></p>
			</h2>

			<div class="login-group">				
				<a href="{{route('temp_home')}}" class="btn black big w50">메인으로</a>
			</div>

		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection