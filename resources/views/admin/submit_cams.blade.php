@extends('admin.layout.main')
@section('content')
    <h1>리뷰 진행중 캠페인목록</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>캠페인명</th>
            <th>브랜드명</th>
            <th>리뷰제출마감일</th>
            <th>선정인원</th>
            <th>선정안내문자발송여부</th>
        </tr>
            </thead>
        <tbody id="list">
            @include('admin.part_submit_cams')
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
    var nowId = $(this).data('r');
        $.ajax({
           type:"post",
           url:'/admin/submit_reviewer/' + nowId,
            success: function(data){
                $('.popup').html(data.finhtml);
                window.location.hash = '#answer'; 
            }
        });
    });
    </script>
@endsection