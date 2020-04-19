@extends('admin.layout.main')
@section('content')
    <h1>리뷰어 모집중 캠페인목록</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>캠페인명</th>
            <th>브랜드명</th>
            <th>모집시작일</th>
            <th>모집마감일</th>
            <th>모집인원</th>
            <th>신청인원</th>
        </tr>
            </thead>
        <tbody id="list">
            @include('admin.part_recruit_cam')
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
           url:'/admin/recruit_reviewer/' + nowId,
            success: function(data){
                $('.popup').html(data.finhtml);
                window.location.hash = '#answer'; 
            }
        });
    });
    </script>
@endsection