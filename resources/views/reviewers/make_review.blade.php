<a href="#select" class="overlay" id="popup_reviewer"></a>
        <div class="popup term" id="make_review">
			<div class="text3">
				<h3>리뷰 URL</h3>
				<p><input name="url" type="text" id="" value="" placeholder="리뷰 URL을 입력해주세요.(ex: http://blog.naver.com/00)" class="full_width" /></p>
				<h3>캠페인 참여 후기</h3>
				<p><textarea name="after" id="" cols="1" rows="5" placeholder="광고주에게 전달할 캠페인 참여후기를 입력해주세요." class="border2"></textarea></p>
				<a class="btn black h46" id="submission">제출</a>
			</div>
            <a class="close2" href="#select"></a>
        </div>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    var nowCam;//캠페인아이디
    var nowCamRe;//캠페인리뷰어아이디
    $('.my-reviewer').on('click','.submission', function(e){
        e.preventDefault();
        window.location.replace( baseUrl + '#popup_reviewer' );
       nowCam = $(this).data('c');//캠페인아이디
        nowCamRe = $(this).data('cr');//캠페인리뷰어아이디
    });
    //리뷰제출 창에서 제출 클릭시
    $('#submission').on('click', function(e){
       e.preventDefault();
        var inputUrl;
        if($('#make_review input[name=url]').val().startsWith('http')){
            inputUrl = $('#make_review input[name=url]').val();
           } else {
              inputUrl = 'http://'+ $('#make_review input[name=url]').val();
           }
        $.ajax({
           type:"POST",
           url:"{{route('reviewers.create_review')}}",
            data:{
                'campaign_id':nowCam,
                'campaign_reviewer_id':nowCamRe,
                'url':inputUrl,
                'after':$('#make_review textarea[name=after]').val(),
            },
            success: function(){
                window.location.replace( baseUrl + '#select' );
            window.location.reload();
            }
        });
    });
</script>