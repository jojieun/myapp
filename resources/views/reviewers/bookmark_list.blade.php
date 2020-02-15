@extends('layouts.main')
@section('content')

<!-- 왼쪽메뉴 -->
@include('reviewers.reviewer_leftmenu')
			
<!-- 오른쪽 컨텐츠 -->
<div class="right-content">
    <h2 class="mb70 m-text-left">관심캠페인</h2>
	<!-- 리뷰어 제안 목록 -->
	<div class="my-reviewer bt2" id="bookmark_list">
        <? $option = 'apply' ?>
		@include('reviewers.part_bookmark_list')
    </div>
    <!-- //나의 캠페인 -->
</div>
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('reviewers.reviewer_bottommenu')

<!--삭제 알림-->
@component('help.popup_ok')
    @slot('goId')
        delete_ok
    @endslot
    삭제 되었습니다.
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

<!--캠페인신청시필요-->
@component('help.pop_require')
    @slot('goId')
        pop_review
    @endslot
    @slot('for')
        캠페인 신청을 위해
    @endslot
    @slot('what')
        리뷰어 로그인
    @endslot
    @slot('where')
        {{ route('sessions.create') }}
    @endslot
@endcomponent

<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    //삭제 클릭시
$('.delete').on('click', function(e){
    e.preventDefault();
    bookmarkId = $(this).data('b');
        $.ajax({
           type:"post",
           url:'delete_bookmark/' + bookmarkId,
            success: function(data){
                $('#bookmark_list').html(data.showhtml);
                window.location.hash = '#delete_ok'; 
            }
        });
    });
    
var camid, bookmarkId;
//신청하기 클릭시
$('.apply').on('click', function(e){
    camid = $(this).data('c');
    bookmarkId = $(this).data('b');
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
               bookmarkId:bookmarkId
           },
            success:function(data){
               if(data.pre_apply){
                   window.location.hash = '#pre_apply';
               } else {
                   $('#bookmark_list').html(data.showhtml);
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