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
				<h2>FAQ</h2>
				
				<!-- 탭-->				
				<ul class="detail_tab2">
					<li><a href="faq.php" class="on">리뷰어</a></li>
					<li><a href="#">광고주</a></li>
				</ul>
				<!-- //탭-->
				
				<ul class="board-tab">
					<li class="on"><a href="#">캠페인 신청</a></li>
					<li><a href="#">리뷰어 선정</a></li>
					<li><a href="#">리뷰제출</a></li>
					<li><a href="#">사이트이용</a></li>
				</ul>

				<!-- 여기부터 FAQ 목록입니다. -->
				<div class="faq">
					<div class="item">
						<div class="heading">
							<p class="list_subj">자주하는 질문입니다?</p>
						</div>
						<div class="content">
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵.<br/>
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵.<br/>
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵.<br/>
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵.<br/>
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵.<br/>
						</div>
					</div>
					<div class="item">
						<div class="heading">
							<p class="list_subj">캠페인 신청은 어떻게 하나요?</p>
						</div>
						<div class="content">
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵.
						</div>
					</div>
					<div class="item">
						<div class="heading">
							<p class="list_subj">캠페인 신청한 것을 취소하고 싶어요!</p>
						</div>
						<div class="content">
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵
						</div>
					</div>
					<div class="item">
						<div class="heading">
							<p class="list_subj">캠페인 신청은 어떻게 하나요?</p>
						</div>
						<div class="content">
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵
						</div>
					</div>
					<div class="item">
						<div class="heading">
							<p class="list_subj">캠페인 신청은 어떻게 하나요?</p>
						</div>
						<div class="content">
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵
						</div>
					</div>
					<div class="item">
						<div class="heading">
							<p class="list_subj">캠페인 신청은 어떻게 하나요?</p>
						</div>
						<div class="content">
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵
						</div>
					</div>
					<div class="item">
						<div class="heading">
							<p class="list_subj">캠페인 신청은 어떻게 하나요?</p>
						</div>
						<div class="content">
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵
						</div>
					</div>
					<div class="item">
						<div class="heading">
							<p class="list_subj">캠페인 신청은 어떻게 하나요?</p>
						</div>
						<div class="content">
						질문에 대한 답이 출력 됩니다요. 이러쿵 저러쿵
						</div>
					</div>
				</div>

			</div>				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection