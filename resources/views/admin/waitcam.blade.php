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
    //삭제(탈퇴)
    $('#list').on('click', '.del', function(e){
        e.preventDefault();
       var cId = $(this).val();
      if (confirm('주의!! 포인트 환급 후 해당 캠페인을 삭제합니다. 삭제 후 복구할 수 없습니다.')) {
        $.ajax({
          type: 'POST',
          url: '/campaigns/' + cId,
            data: {"campaign": cId , _method: 'delete'},
        success:function(data){
        }
        }).then(function () {
          window.location.href = "{{route('admin.waitConfirmCam')}}";
        });
      }
    });
    //수정클릭
    $('#list').on('click', '.modi', function(e){
        e.preventDefault();
       var cId = $(this).val();
        $.ajax({
            type:"get",
          url: '/admin/edit_a/' + cId,
        success:function(data){
                $('.popup').html(data.showhtml)
                window.location.hash = '#answer'; 
        }
        });
    });
    </script>
@endsection