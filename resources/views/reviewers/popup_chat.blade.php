<a href="#select" class="overlay" id="popup_chat"></a>
<div class="popup term" id="chat_wrap">     
</div>
<script>
$('.chat_button').on('click', function(e){
    var ad = $(this).data('ad');
    var url = "{{ route('messages.index', ":ad") }}";
    url = url.replace(':ad', ad);
    $.ajax({
       type:"get",
       url:url,
        success: function(data){
            $('#chat_wrap').html(data.showhtml)
            window.location.replace( baseUrl + '#popup_chat' );
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
                advertiser_id:$('#chat_header').data('adid'),
                from_ad:$('#chat_header').data('fromad'),
                text:$('#input_message').val(),
            },
            success:function(data){
                alert(data.now);
            },
            error: function(data) {
                if(data.status==422){
alert(data);
                }
            }
        });
    }
}
$('#input_message').keyup(function(key){
   if(key.keyCode==13){
       save_message();
   } 
});
</script>