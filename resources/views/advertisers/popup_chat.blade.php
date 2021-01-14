<a href="#select" class="overlay" id="popup_chat"></a>
<div class="popup term" id="chat_wrap">     
</div>
<script>
    
    var url;
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
    var ad = $(this).data('ad');//광고주아이디
    var re = $(this).data('re');//리뷰어아이디
    url = "{{ route('messages.index2', [":ad", ":re"]) }}";
    url = url.replace(':ad', ad);
    url = url.replace(':re', re);
    makeChat();
    window.location.replace( baseUrl + '#popup_chat' );
//    window.Echo.private('chats').listen('MessageSent', e => {
//        window.Laravel = {!! json_encode([ 'advertiser' => auth()->guard('advertiser')->user()])  !!};

window.Echo.private('adchats').listen('MessageSent', e => {
        
        if (e.message.advertiser_id == ad && e.message.reviewer_id == re) {
            makeChat();
        }
    });
    
});
//message저장
function save_message(){
    if($('#input_message').val()){ 
        $.ajax({
            type:"POST",
            url:"{{ route('messages.store') }}",
            data:{
                advertiser_id:"{{auth()->guard('advertiser')->user()->id}}",
                reviewer_id:$('#chat_header').data('reid'),
                from_ad:$('#chat_header').data('fromad'),
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