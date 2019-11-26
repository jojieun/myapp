@extends('admin.layout.main')
@section('content')
    <h1>공지사항 관리</h1>
<h2>새 공지사항 만들기</h2>
    <form id="makefaq" type="post">
        {!! csrf_field() !!}
        <table>
    `   <tr>
            <th>제목</th>
        <td>
            <input name="title"  value="{{ old('title') }}">
            </td>
        </tr>
        <tr>
            <th>내용</th>
        <td><textarea name="content" rows="5">{{ old('content') }}</textarea></td>
        </tr>
            <tr>
                <td colspan="1000" align="right">
                    <button id="makefaq_b">저장</button>
                </td>
            </tr>
    </table>
    </form>
<h2>공지사항 목록</h2>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>작성일</th>
            <th>처리</th>
        </tr>
        </thead>
        <tbody id="list">
            @include('admin.part_notice')
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
    //새 공지사항 저장 클릭시
    $('#makefaq_b').on('click', function(e){
       e.preventDefault();
        $.ajax({
           type:"POST",
           url:'{{route('notices.store')}}',
            data:{
                'title':$('#makefaq input[name=title]').val(),
                'content':$('#makefaq textarea[name=content]').val(),
            },
            success: function(data){
                $('#list').html(data.finhtml);
                $('#makefaq')[0].reset();
            }
        });
        
    });
    //목록삭제
    $('#list').on('click', '.del', function(e){
        e.preventDefault();
       var rfaqId = $(this).val();

      if (confirm('해당 공지사항을 삭제합니다.')) {
        $.ajax({
          type: 'DELETE',
          url: '/notices/' + rfaqId,
        success:function(data){
          $('#list').html(data.finhtml);
        }
        })
      }
    });
    
    //목록에서 수정 클릭시
$('#list').on('click','.edit', function(e){
       e.preventDefault();
    var nowId = $(this).val();
        $.ajax({
           type:"get",
           url:'/notices/' + nowId + '/edit',
            success: function(data){
                $('.popup').html(data.showhtml)
                window.location.hash = '#answer'; 
            }
        });
        
    });
    // 수정입력 클릭시
    $('.popup').on('click','#modal_submit', function(e){
       e.preventDefault();
    var nowId = $(this).data('id');
        $.ajax({
           type:"put",
           url:'/notices/' + nowId,
            data:{
                'title':$('#answer input[name=title]').val(),
                'content':$('#answer textarea[name=content]').val(),
            },
            success: function(data){
                window.location.hash = '#close'; 
                $('#list').html(data.finhtml)
            }
        });
        
    });
    </script>
@endsection