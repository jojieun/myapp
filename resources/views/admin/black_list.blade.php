@extends('admin.layout.main')
@section('content')
    <h1>미제출 리뷰어(블랙리스트)목록</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>이메일</th>
            <th>이름</th>
            <th>전화번호</th>
            <th>미제출캠페인</th>
            <th>캠페인종료일</th>
            <th>미제출기간</th>
            <th>패널티</th>
        </tr>
            </thead>
        <tbody id="list">
            @include('admin.part_black_list')
            </tbody>
</table>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    //패널티 삭제
    $('#list').on('click', '.del', function(){
       var penaltyId = $(this).data('id');

      if (confirm('패널티를 해제합니다.')) {
        $.ajax({
          type: 'DELETE',
          url: '/delPenalty/' + penaltyId,
        success:function(data){
          $('#list').html(data.finhtml);
        }
        })
      }
    });
    //패널티 부여
    $('#list').on('click', '.apply', function(){
        var penalty = $(this).prev().val();
        if(penalty){
            $.ajax({
                url : "{{ route('storePenalty') }}",
                type : "post",
                dataType: 'json',
                data:{
                    reviewer_id: $(this).data('rid'),
                    fixed_date: penalty,
                },
                success:function(data){
                  $('#list').html(data.finhtml);
                },
                error: function(request,status,error) {
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
                }
            });
        }
    });
</script>
@endsection