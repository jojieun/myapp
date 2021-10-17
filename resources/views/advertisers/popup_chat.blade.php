<a href="#select" class="overlay close_button" id="popup_chat"></a>
<div class="popup term" id="chat_wrap">     
</div>
<script>
    
    var url;
    var ad;//광고주아이디
    var re;//리뷰어아이디
    var id_cam;//캠페인아이디
    var nowOpen = false;//현재 채팅창을 보고있는지
    $('body').on('click','.close_button',function(){
        nowOpen = false;
    });
    function makeChat(){
        $.ajax({
       type:"get",
       url:url,
        success: function(data){
            $('#chat_wrap').html(data.showhtml);
            $('#chat_area_wrap').scrollTop($('#chat_area').height());
            }
        });
    }
$('.chat_button').on('click', function(e){
    nowOpen = true;//채팅창을 보고 있음
    ad = $(this).data('ad');//광고주아이디
    re = $(this).data('re');//리뷰어아이디
    id_cam = $(this).data('cam');//캠페인아이디
    url = "{{ route('messages.index2', [":ad", ":re", ":id_cam"]) }}";
    url = url.replace(':ad', ad);
    url = url.replace(':re', re);
    url = url.replace(':id_cam', id_cam);
    makeChat();
    window.location.replace( baseUrl + '#popup_chat' );

//window.Echo.private('adchats').listen('MessageSent', e => {
//        
//        if (e.message.advertiser_id == ad && e.message.reviewer_id == re && nowOpen) {
//            makeChat();
//        }
//    });
    window.Echo.private('App.Advertiser.'+ad).listen('MessageSent', e => {
          if (e.message.reviewer_id == re && e.message.campaign_id == id_cam && nowOpen) {
              makeChat();
          }
      });
});
//message저장
function save_message(){
    if($('#input_message').val()){ 
        $.ajax({
            headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
            type:"POST",
            url:"{{ route('messages.store') }}",
            data:{
                advertiser_id:ad,
                reviewer_id:re,
                campaign_id:id_cam,
                from_ad:1,
                text:$('#input_message').val(),
            },
            success:function(data){
                $('#input_message').val('');
                $('#chat_area').append('<div class="my chat"><div class="message"><span class="text">'+data.text+'</span><span class="time">'+data.now+'</span></div></div>');
                $('#chat_area_wrap').scrollTop($('#chat_area').height());
            },
            error: function(data) {
                if(data.status==422){
                    alert('메시지전송에 문제가 있습니다.');
                }
            }
        });
    }
}
$('#chat_wrap').on('keyup', '#input_message', function(key){
   if(key.keyCode==13){
       save_message();
   } 
});
</script>