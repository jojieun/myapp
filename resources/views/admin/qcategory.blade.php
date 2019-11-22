@extends('admin.layout.main')
@section('content')
    <h1>1:1 문의 카테고리 관리</h1>
<h2>1:1문의 카테고리 목록</h2>
    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th>카테고리명</th>
                <th>처리</th>
            </tr>
        </thead>
        <tbody>
            @include('admin.part_qcategory')
        </tbody>
</table>
<h2>1:1문의 카테고리 추가</h2>
<form method="post">
{!! csrf_field() !!}
    <input id="name" name="name" class="in">
    <button id="plus">추가</button>
</form>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    //카테고리목록삭제
    $('tbody').on('click', '.del', function(e){
        e.preventDefault();
       var qcategoryId = $(this).data('id');

      if (confirm('카테고리를 삭제합니다.')) {
        $.ajax({
          type: 'DELETE',
          url: '/admin/delQCategory/' + qcategoryId,
            data:{
            id: qcategoryId,
        },
        success:function(data){
          $('tbody').html(data.finhtml);
        }
        })
      }
    });
    var name;
$('#plus').on('click', function(e){
       e.preventDefault();
        name = $('input[name=name]').val();
        getDatas();
    });
    
    function getDatas() {
    $.ajax({
        url : "{{ route('admin.makeQCategory') }}",
        type : "post",
        dataType: 'json',
        data:{
            name: name,
        },
        success:function(data){
          $('tbody').html(data.finhtml);
        },
        error: function(request,status,error) {
            alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
        }
        });
    }
    </script>
@endsection