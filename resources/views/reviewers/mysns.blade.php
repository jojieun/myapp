@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
                <h2 class="mb70 m-text-left"><b>mySNS</b></h2>		
                <form method="post" action="{{ route('reviewers.update_mysns') }}">
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
<!--리뷰작성-->
<a href="#" class="overlay" id="popup_reviewer"></a>
        <div class="popup term">
			<div class="text3">
				<h3>리뷰 URL</h3>
				<p><input name="url" type="text" id="" value="" placeholder="리뷰 URL을 입력해주세요." class="full_width" /></p>
				<h3>캠페인 참여 후기</h3>
				<p><textarea name="after" id="" cols="1" rows="5" placeholder="광고주에게 전달할 캠페인 참여후기를 입력해주세요." class="border2"></textarea></p>
				<a class="btn black h46" id="submission">제출</a>
			</div>
            <a class="close" href="#select"></a>
        </div>
<!--리뷰수정-->
<a href="#close" class="overlay" id="edit_review"></a>
<div class="popup term" id="edit_r">
    
</div>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    var nowCam;
    $('.my-reviewer').on('click','.submission', function(){
       nowCam = $(this).data('c');
    });
    //리뷰제출 창에서 제출 클릭시
    $('#submission').on('click', function(e){
       e.preventDefault();
        $.ajax({
           type:"POST",
           url:"{{route('reviewers.create_review')}}",
            data:{
            'campaign_id':nowCam,
                'url':$('input[name=url]').val(),
                'after':$('textarea[name=after]').val(),
            },
            success: function(){
                window.location.hash ='#select';
            window.location.reload();
            }
        });
        
    });
    
        //리뷰수정 클릭시
$('.edit_review').on('click', function(e){
//       e.preventDefault();
    var nowId = $(this).data('r');
        $.ajax({
           type:"get",
           url:'edit_review/' + nowId,
            success: function(data){
                $('#edit_r').html(data.showhtml)
                window.location.hash = '#edit_review'; 
            }
        });
        
    });
    // 수정입력 클릭시
    $('#edit_r').on('click','#modal_submit', function(e){
       e.preventDefault();
    var nowId = $(this).data('id');
        $.ajax({
           type:"put",
           url:'update_review/' + nowId,
            data:{
                'url':$('#answer input[name=url]').val(),
                'after':$('#answer textarea[name=after]').val(),
            },
            success: function(data){
                window.location.hash = '#select'; 
            }
        });
        
    });
    
//                    캠페인 탭 바꾸기
    window.location.hash='#apply';
    changeTab();
    $(window).on('hashchange', function(e){
        changeTab();
    });
    function changeTab(){
        var nowHash = window.location.hash;
        $('.mypage-tab li a').removeClass('on');
        if(nowHash=='#apply'){
            $('.mypage-tab li a').eq(0).addClass('on');
        }else if(nowHash=='#select'){
            $('.mypage-tab li a').eq(1).addClass('on');
        }else if(nowHash=='#end'){
            $('.mypage-tab li a').eq(2).addClass('on');
        }
    }
//    리뷰제출
</script>

@endsection