@extends('layouts.main')
@section('content')
@include('advertisers.advertiser_leftmenu')	
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<div class="step4 text-center">
                    <p class="title"><b>포인트환불이 완료되었습니다.</b></p>
					<p class="txt">
                        미제출(선정)리뷰어 인원 : {{$personnel}}<br>
                        중계수수료 + 제공포인트 (인당) : {{$amount}}<br>
                        환불포인트 : {{$refund_point}}
                    </p>
                    <p class="txt">
                        포인트는 새캠페인 결제 시 사용 할 수 있습니다.
                    </p>

					<div class="login-group">				
						<a href="{{ route('main') }}" class="btn big w50">메인으로</a>
						<a href="{{ route('advertisers.managecampaign').'#waitCampaigns' }}" class="btn black big w50">캠페인 관리 페이지로</a>
					</div>
				</div>
			</div>
@include('advertisers.advertiser_leftmenu_tail')
@endsection