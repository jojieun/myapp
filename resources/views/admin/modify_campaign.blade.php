@extends('admin.layout.main')
@section('content')
    <h1>수정요청 캠페인목록</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>요청일</th>
            <th>캠페인명</th>
            <th>브랜드명</th>
            <th>처리</th>
        </tr>
            </thead>
        <tbody id="list">
            @include('admin.part_modify_campaign')
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
    var modiId = $(this).data('id');
        var camId = $(this).data('camid');
        $.ajax({
           type:"get",
           url:'/admin/show_modify/' + modiId + '/'+ camId,
            success: function(data){
                $('.popup').html(data.showhtml);
                window.location.hash = '#answer'; 
            }
        });
        
    });
$('.popup').on('click','.confirm', function(e){
       e.preventDefault();
        var nowId = $(this).val();
    var c_result = $(this).data('r');
        $.ajax({
           type:"POST",
           url:"{{ route('admin.confirmModify') }}",
           data:{
               nowId:nowId,
               c_result:c_result
           },
            success: function(data){
                $('#list').html(data.finhtml);
                window.location.hash = '#';
            }
        });
    });
    </script>
@endsection