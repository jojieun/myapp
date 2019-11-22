@extends('admin.layout.main')
@section('content')
    <h1>답변완료 1:1 문의 목록</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>카테고리</th>
            <th>문의제목</th>
            <th>문의자</th>
            <th>문의날짜</th>
            <th>답변제목</th>
            <th>답변날짜</th>
            <th>처리</th>
        </tr>
        </thead>
        <tbody id="list">
            @include('admin.part_list_answer2')
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
           type:"POST",
           url:'/admin/openanswer/' + nowId,
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
           type:"POST",
           url:'/admin/saveanswer2/' + nowId,
            data:{
                'answer_title':$('input[name=answer_title]').val(),
                'answer':$('textarea[name=answer]').val(),
            },
            success: function(data){
                window.location.hash = '#close'; 
                $('#list').html(data.finhtml)
            }
        });
        
    });
    </script>
@endsection