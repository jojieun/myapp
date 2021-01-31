@extends('admin.layout.main')
@section('content')
    <h1>검수 대기중 캠페인목록</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>작성일</th>
            <th>캠페인명</th>
            <th>브랜드명</th>
            <th>처리</th>
        </tr>
            </thead>
        <tbody id="list">
            @include('admin.part_waitcam')
            </tbody>
</table>
<a href="#close" class="overlay" id="answer"></a>
<div class="popup">
    
</div>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    //보기
    $('#list').on('click', '.show', function(e){
       e.preventDefault();
    var nowId = $(this).data('id');
        $.ajax({
           type:"get",
           url:'/admin/showwait/' + nowId,
            success: function(data){
                $('.popup').html(data.showhtml);
                window.location.hash = '#answer'; 
            }
        });
    });
    //검수
$('.popup').on('click','.confirm', function(e){
       e.preventDefault();
        var nowId = $(this).val();
        $.ajax({
           type:"POST",
           url:"{{ route('admin.confirmcampaign') }}",
           data:{
               nowId:nowId,
           },
            success: function(data){
                $('#list').html(data.finhtml);
                window.location.hash = '#';
            }
        });
    });
    //삭제함수
    function delCam(val){
        var cId = val;
      if (confirm('주의!! 포인트 환급 후 해당 캠페인을 삭제합니다. 삭제 후 복구할 수 없습니다.')) {
        $.ajax({
          type: 'POST',
          url: '/campaigns/' + cId,
            data: {"cId": cId, "_method": 'delete',},
        success:function(data){
        }
        }).then(function () {
          window.location.href = "{{route('admin.waitConfirmCam')}}";
        });
      }
    }
    //삭제
    $('#list').on('click', '.del', function(e){
        e.preventDefault();
       delCam($(this).val());
    });
    //삭제하기2
    $('.popup').on('click', '.del', function(e){
        e.preventDefault();
       delCam($(this).val());
    });
    //수정하기클릭
    $('.popup').on('click', '.modify', function(e){
        e.preventDefault();
       var cId = $(this).val();
        $.ajax({
            type:"get",
          url: '/admin/edit_a/' + cId,
        success:function(data){
                $('.popup').html(data.showhtml);
        }
        });
    });
    //수정저장
    $('.popup').on('click', '.modify_save', function(e){
        e.preventDefault();
        var s_data = new FormData($("#modify_form")[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('campaigns.update_a') }}",
            data: s_data,
            cache:false,
            processData: false,
            contentType: false,
            success: function(data) {
                        $('span').filter('.red').html('');
                        $('.popup').html(data.showhtml);
                    },
            error: function(data) {
                        notWork=true;
                        if(data.status==422){
                            $('span').filter('.red').html('');
                            $.each(data.responseJSON.errors, function (i, error) {
                                var el = $('.red').filter('#'+i);
                                el.html(error[0]);
                            });
                        }
                    },
                    
                });


    });
    //수정-지역선택
    $('.popup').on('change','#regions',function(e){
       e.preventDefault();
        var now = $(this).val();
        if(now!='선택'){
        var $data = new FormData();
        $data.append('region', now);
        $.ajax({
        type: 'POST',
        url: "{{ route('campaigns.makearea') }}",
        data: $data,
        success: function(data) {
            var obj = data.areas;
            $('#areas').removeClass('hide');
            var your_html = "";
            $.each(obj, function (key, val) {
                your_html += "<option value='"+val.id+"'>" +  val.name + "</option>"
            });
         $("#areas").html(your_html) 
        },
        error: function(data) {
        },
        processData: false,
        contentType: false
            });
        } else {
            $('#areas').addClass('hide');
            $('#areas').val('');
        }
        
    });
    // ------캠페인 지역 선택
    </script>
@include('help.addjs')
@endsection