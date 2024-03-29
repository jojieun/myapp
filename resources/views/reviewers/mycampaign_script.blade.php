<!--리뷰작성-->
@include('reviewers.make_review')
<!--리뷰수정-->
@include('reviewers.edit_review')
<!--광고주와 채팅-->
@include('reviewers.popup_chat')
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
// 캠페인 탭 바꾸기
    changeTab();
    $(window).on('hashchange', function(e){
        changeTab();
    });
    function changeTab(){
        var nowHash = window.location.hash;
        if(nowHash==''){
           window.location.hash='#apply';
           }
        $('.mypage-tab li a').removeClass('on');
        if(nowHash=='#apply'){
            $('.mypage-tab li a').eq(0).addClass('on');
        }else if(nowHash=='#select'){
            $('.mypage-tab li a').eq(1).addClass('on');
        }else if(nowHash=='#end'){
            $('.mypage-tab li a').eq(2).addClass('on');
        }
    }
    //방문 수취 확인
    $('.take_visit').on('click', function(e){
        e.preventDefault();
        var result;
        if($(this).data('type')=='v'){
            result = confirm('리뷰할 매장을 방문하셨습니까? 방문확인 후 리뷰를 제출할 수 있습니다.');
        } else {
            result = confirm('리뷰할 상품을 배송받으셨습니까? 수취확인 후 리뷰를 제출할 수 있습니다.');
        }
        if(result){
            $.ajax({
                type:"POST",
                url:"{{route('reviewers.take_visit')}}",
                data:{
                    'id':$(this).data('cri'), "_token": "{{ csrf_token() }}"
                },
                success: function(){
                    window.location.reload();
                }
            });
        }
    });

</script>