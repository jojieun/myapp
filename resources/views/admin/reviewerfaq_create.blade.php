@extends('admin.layout.main')
@section('content')
    <h1>리뷰어 FAQ 관리</h1>
<h2>새 리뷰어 FAQ 만들기</h2>
    <form id="makefaq" type="post">
        {!! csrf_field() !!}
        <table>
            <tr>
                <th>카테고리</th>
                <td>
                    <select name="cate">
                        @forelse($rfcategories as $rfcategory)
                        <option value="{{$rfcategory->id}}">{{$rfcategory->name}}</option>
                        @empty
                        <option value="">카테고리가 없습니다</option>
                        @endforelse
                    </select>
                </td>
            </tr>
    `   <tr>
            <th>답변제목</th>
        <td>
            <input name="question"  value="{{ old('question') }}">
            </td>
        </tr>
        <tr>
            <th>답변</th>
        <td><textarea name="answer" rows="5">{{ old('answer') }}</textarea></td>
        </tr>
            <tr>
                <td colspan="1000" align="right">
                    <button id="makefaq_b">저장</button>
                </td>
            </tr>
    </table>
    </form>
<h2>리뷰어 FAQ 목록</h2>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>카테고리</th>
            <th>질문</th>
            <th>작성날짜</th>
            <th>처리</th>
        </tr>
        </thead>
        <tbody id="list">
            @include('admin.part_reviewerfaq')
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
    //새 리뷰어 FAQ 저장 클릭시
    $('#makefaq_b').on('click', function(e){
       e.preventDefault();
        $.ajax({
           type:"POST",
           url:'{{route('reviewer_faqs.store')}}',
            data:{
                'question':$('#makefaq input[name=question]').val(),
                'answer':$('#makefaq textarea[name=answer]').val(),
                'reviewer_faq_cate_id':$('#makefaq select[name=cate]').val(),
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

      if (confirm('해당 리뷰어 FAQ를 삭제합니다.')) {
        $.ajax({
          type: 'DELETE',
          url: '/reviewer_faqs/' + rfaqId,
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
//           url:'/reviewer_faqs/editShow/' + nowId,
           url:'/reviewer_faqs/' + nowId + '/edit',
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
           type:"put",
           url:'/reviewer_faqs/' + nowId,
            data:{
                'question':$('#answer input[name=question]').val(),
                'answer':$('#answer textarea[name=answer]').val(),
                'reviewer_faq_cate_id':$('#answer select[name=cate]').val(),
            },
            success: function(data){
                window.location.hash = '#close'; 
                $('#list').html(data.finhtml)
            }
        });
        
    });
    </script>
@endsection