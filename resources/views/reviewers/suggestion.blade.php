@extends('layouts.main')
@section('content')

<!-- 왼쪽메뉴 -->
@include('reviewers.reviewer_leftmenu')
			
<!-- 오른쪽 컨텐츠 -->
<div class="right-content">
    <h2 class="mb70 m-text-left">리뷰어 제안</h2>
	<!-- 리뷰어 제안 목록 -->
	<div class="my-reviewer bt2" id="suggestion_list">
		@include('reviewers.part_suggestion')
    </div>
    <!-- //나의 캠페인 -->
</div>
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('reviewers.reviewer_bottommenu')

<!--제안거절 알림-->
@component('help.popup_ok')
    @slot('goId')
        no_accept
    @endslot
    제안 거절 되었습니다.
@endcomponent

<!--신청약관-->
@include('campaigns.suggestion_pop_term')

<!--신청완료알림-->
@component('help.popup_ok')
    @slot('goId')
        popup_ok
    @endslot
    신청이 완료되었습니다.
@endcomponent

<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    //제안거절 클릭시
$('.no_accept').on('click', function(e){
    e.preventDefault();
    var suggestId = $(this).data('s');
        $.ajax({
           type:"post",
           url:'no_accept/' + suggestId,
            success: function(data){
                $('#suggestion_list').html(data.showhtml);
                window.location.hash = '#no_accept'; 
            }
        });
    });
    
var camId, suggestId;
//제안수락 클릭시
$('.no_accept').on('click', function(e){
    camId = $(this).data('c');
    suggestId = $(this).data('s');
});
    
//캠페인신청
 $('#campaign_apply').on('click', function(e){
     e.preventDefault();
     if($('#checkAgree1').is(':checked') && $('#checkAgree2').is(':checked')){
        $.ajax({
           type:"POST",
           url:"{{ route('reviewers.apply') }}",
           data:{
               camid:camid,
               suggestId:suggestId
           },
            success:function(data){
               if(data.pre_apply){
                   window.location.hash = '#pre_apply';
               } else {
                   $('#suggestion_list').html(data.showhtml);
                   window.location.hash = '#popup_ok';
               }
            },
            error: function(data) {
                if(data.status==401){
                    window.location.hash = '#pop_review';
                }
            },
        });
         
     } else {
         alert('약관에 동의해주세요');
     }
 });

</script>

@endsection