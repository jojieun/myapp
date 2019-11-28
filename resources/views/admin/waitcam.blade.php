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
    </script>
@endsection