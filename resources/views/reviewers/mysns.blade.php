@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
                <h2 class="mb70 m-text-left"><b>mySNS</b></h2>		
                <form method="post" action="{{ route('reviewers.update_mysns') }}" onsubmit="return confirm('정확히 입력하셨습니까?')">
                    {!! csrf_field() !!}
                    {!! method_field('PUT') !!}
				<!-- 기본정보 입력 -->
				<div class="join-snsurl">
					<ul>
                        @foreach($chls as $chl)
                        <li>
							<span>{{$chl->url}}</span>
                            
                        @if($val=$user->channelreviewers->where('channel_id',$chl->id)->first())
                            <input name="{{$chl->id}}" type="text" value="{{ old('$chl->id', $val->name)}}"/>
                        @else
                        <input name="{{$chl->id}}" type="text" value="{{ old('$chl->id')}}"/>
                        @endif
                            </li>
                        @endforeach
					</ul>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap">
					<button type="submit" class="btn black">수정하기</button>
				</div>
                </form>
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('reviewers.reviewer_bottommenu')
<script>
</script>

@endsection