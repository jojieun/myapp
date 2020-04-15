@extends('admin.layout.main')
@section('content')
    <h1>광고주 회원 목록</h1>
<a href="{{route('admin.down_advertiser')}}" class="down_excel">광고주 회원 목록 엑셀 다운로드</a>
    <table id="advertiser_list">
        <thead>
            <tr>
                <th>번호</th>
                <th>이메일</th>
                <th>이름</th>
                <th>전화번호</th>
                <th>메일,sns수신동의</th>
                <th>가입일</th>
                <th>가입정보수정일</th>
                <th>처리</th>
            </tr>
        </thead>
        @forelse ($advertisers as $advertiser)
        <tbody>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $advertiser->email }}</td>
                <td>{{ $advertiser->name }}</td>
                <td>{{ $advertiser->mobile_num }}</td>
                <td>{{ $advertiser->receive_agreement }}</td>
                <td>{{ $advertiser->created_at }}</td>
                <td>{{ $advertiser->updated_at }}</td>
                <td>
                    <button class="modi" value="{{$advertiser->id}}">수정</button>
                    <button class="del" value="{{$advertiser->id}}">탈퇴(삭제)</button>
                </td>
            </tr>
        </tbody>
        @empty
        <tr>
            <td colspan=100>광고주가 없습니다.</td>
        </tr>
        @endforelse
</table>
{{ $advertisers->links() }}
<a href="#close" class="overlay" id="answer"></a>
<div class="popup">
    
</div>
<script>
$.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    //삭제(탈퇴)
    $('#advertiser_list').on('click', '.del', function(e){
        e.preventDefault();
       var aId = $(this).val();
      if (confirm('해당 광고주를 삭제합니다. 삭제 후 복구할 수 없습니다.')) {
        $.ajax({
          type: 'POST',
          url: '/advertisers/' + aId,
            data: {"aId": aId , _method: 'delete'},
        success:function(data){
        }
        }).then(function () {
          window.location.href = "{{route('admin.advertisers')}}";
        });
      }
    });
    //수정클릭
    $('#advertiser_list').on('click', '.modi', function(e){
        e.preventDefault();
       var aId = $(this).val();
        $.ajax({
            type:"get",
          url: '/advertisers/' + aId+'/edit',
        success:function(data){
                $('.popup').html(data.showhtml)
                window.location.hash = '#answer'; 
        }
        });
    });
</script>
@endsection