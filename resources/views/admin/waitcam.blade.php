@extends('admin.layout.main')
@section('content')
    <h1>검수 대기중 캠페인목록</h1>
    <table>
        <tr>
            <th>번호</th>
            <th>메인이미지</th>
            <th>캠페인명</th>
            <th>브랜드명</th>
            <th>처리</th>
        </tr>
        @forelse ($waitCampaigns as $waitCampaign)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><img src="/files/{{$waitCampaign->main_image}}" width="50"></td>
            <td>{{$waitCampaign->name}}</td>
            <td>{{$waitCampaign->brand->name}}</td>
            <td><button class="confirm" value="{{$waitCampaign->id}}">검수하기</button></td>
        </tr>
        @empty
        <tr>
            <td colspan=100>검수 대기중인 캠페인이 없습니다.</td>
        </tr>
        @endforelse
</table>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
$('.confirm').on('click', function(e){
       e.preventDefault();
        var nowId = $(this).val();
        $.ajax({
           type:"POST",
           url:"{{ route('admin.confirmcampaign') }}",
           data:{
               nowId:nowId,
           },
            success: function(){
            window.location.href = '/admin';
            }
        });
    });
    </script>
@endsection