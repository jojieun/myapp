@extends('layouts.main')
@section('content')
@include('layouts.advertiser_leftmenu')	
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<div class="step4 text-center">
					<p class="title"><b>결제가 완료되었습니다.</b>캠페인 검수 후 등록됩니다.</p>
					<p class="txt">캠페인 진행 상황은 캠페인 관리 페이지에서 확인하실 수 있습니다.</p>

					<div class="login-group">				
						<a href="{{ route('main') }}" class="btn big w50">메인으로</a>
						<a href="client_0201.php" class="btn black big w50">캠페인 관리 페이지로</a>
					</div>
				</div>
			</div>
@include('layouts.advertiser_leftmenu_tail')
@endsection