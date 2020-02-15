@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
                <h2 class="mb70 m-text-left">mySNS 수정이 완료되었습니다.</h2>
				<div class="join-snsurl">
					<ul>
                        @foreach($chls as $chl)
                        <li>
							<span>{{$chl->url}}</span>
                            
                        @if($val=$user->channelreviewers->where('channel_id',$chl->id)->first())
                            {{$val->name}}
                        @else
                        없음
                        @endif
                            </li>
                        @endforeach
					</ul>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap">
					<a a href="{{ route('reviewers.mysns') }}" class="btn">mySNS 재수정</a>
					<a a href="{{ route('reviewers.mypage') }}" class="btn black">마이페이지 메인으로</a>
				</div>
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('reviewers.reviewer_bottommenu')
@endsection