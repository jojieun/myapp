@extends('admin.layout.main')
@section('content')
    <h1>캠페인 대행 의뢰 목록</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>의뢰제목</th>
            <th>의뢰자</th>
            <th>의뢰날짜</th>
            <th>처리</th>
        </tr>
        </thead>
        <tbody id="list">
            @include('admin.part_list_agency')
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
    //목록에서 답변하기 클릭시
$('#list').on('click','.answer', function(e){
       e.preventDefault();
    var nowId = $(this).val();
        $.ajax({
           type:"GET",
           url:'../advertiser/agency/' + nowId + '/edit',
            success: function(data){
                $('.popup').html(data.showhtml)
            window.location.hash = '#answer'; 
            }
        });
        
    });
    // 답변입력 클릭시
    $('.popup').on('click','#modal_submit', function(e){
       e.preventDefault();
    var nowId = $(this).data('id');
        $.ajax({
           type:"PUT",
           url:'../advertiser/agency/' + nowId,
            data:{
                'process':$('input[name=process]').val(),
            },
            success: function(data){
                window.location.hash = '#close'; 
                $('#list').html(data.finhtml)
            }
        });
        
    });
    </script>
@endsection