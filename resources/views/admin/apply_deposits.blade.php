@extends('admin.layout.main')
@section('content')
    <h1>포인트 출금신청내역</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>신청자명</th>
            <th>신청자연락처</th>
            <th>은행</th>
            <th>계좌번호</th>
            <th>예금주</th>
            <th>신청포인트</th>
            <th>이체할금액</th>
            <th>신청일</th>
            <th>처리</th>
        </tr>
            <tr>
            <th colspan="10">신분증사본</th>
            </tr>
        </thead>
        <tbody id="list">
            @include('admin.part_apply_deposit')
        </tbody>
</table>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    //입금완료처리 클릭시
$('.process').click(function(e){
       e.preventDefault();
        $.ajax({
           type:"POST",
           url:"{{route('admin.process_deposits')}}",
            data:{depositId:$(this).data('d'),
                 reviewerId:$(this).data('r'),
                 amount:$(this).data('a')},
            success: function(data){
                alert('입금완료처리 되었습니다.');
                $('#list').html(data.finhtml);
            },
        error: function(data) {
            alert('입금완료처리에 문제가 있습니다. 관리자에게 연락주세요!');
        },
        });
    });
    </script>
@endsection