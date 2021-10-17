
<a href="#select" class="overlay" id="edit_review"></a>
<div class="popup term" id="edit_r">  
</div>
<script>
    //리뷰수정 클릭시
    $('.edit_review').on('click', function(e){
    var nowId = $(this).data('r');
        $.ajax({
            headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
           type:"get",
           url:'edit_review/' + nowId,
            success: function(data){
                $('#edit_r').html(data.showhtml)
                window.location.replace( baseUrl + '#edit_review' );
            }
        });
    });
    // 수정입력 클릭시
    $('#edit_r').on('click','#modal_submit', function(e){
       e.preventDefault();
    var nowId = $(this).data('id');
        var inputUrl;
        if($('#answer input[name=url]').val().startsWith('http')){
            inputUrl = $('#answer input[name=url]').val();
           } else {
              inputUrl = 'http://'+ $('#answer input[name=url]').val();
           }
        $.ajax({
            headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
           type:"put",
           url:'update_review/' + nowId,
            data:{
                'url':inputUrl,
                'after':$('#answer textarea[name=after]').val(),
            },
            success: function(data){
                window.location.hash = '#select'; 
            }
        });
        
    });
</script>