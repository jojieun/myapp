@extends('admin.layout.main')
@section('content')
<h1>캠페인 홍보옵션 설정</h1>
<table>
    <thead>
        <tr>
            <th>번호</th>
            <th>옵션명</th>
            <th>가격</th>
            <th>신청가능개수</th>
            <th>옵션설명</th>
            <th>수수료면제인원</th>
            <th>수정</th>
        </tr>
    </thead>
    <tbody id="list">
        @include('admin.part_promotion')
    </tbody>
</table>

<a href="#close" class="overlay" id="edit_promotion"></a>
<div class="popup">

</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //목록에서 수정 클릭시
    $('.edit').click(function(e) {
        e.preventDefault();
        var nowId = $(this).val();
        $.ajax({
            type: "get",
            url: 'edit_promotion/' + nowId,
            success: function(data) {
                $('.popup').html(data.finhtml)
                window.location.hash = '#edit_promotion';
            }
        });
    });
</script>
@endsection