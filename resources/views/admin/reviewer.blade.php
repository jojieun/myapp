@extends('admin.layout.main')
@section('content')
    <h1>리뷰어 회원 목록</h1>
<a href="{{route('admin.down_reviewer')}}" class="down_excel">리뷰어 회원 목록 엑셀 다운로드</a>
    <table id="reviewer_list">
        <thead>
            <tr>
                <th>번호</th>
                <th>이메일</th>
                <th>이름</th>
                <th>닉네임</th>
                <th>전화번호</th>
                <th>주소</th>
                <th>생년월일</th>
                <th>성별</th>
                <th>수신동의</th>
                <th>가입일</th>
                <th>정보수정일</th>
                <th>포인트</th>
                <th>sns</th>
                <th>리뷰전략</th>
                <th>처리</th>
            </tr>
        </thead>
        @forelse ($reviewers as $reviewer)
        <tbody>
            <tr>
                <td>{{ $loop->iteration + 50 * ($reviewers->currentPage() -1) }}</td>
                <td>{{ $reviewer->email }}</td>
                <td>{{ $reviewer->name }}</td>
                <td>{{ $reviewer->nickname }}</td>
                <td>{{ $reviewer->mobile_num }}</td>
                <td>[{{ $reviewer->zipcode }}] {{ $reviewer->address }} {{ $reviewer->detail_address }}</td>
                <td>{{ $reviewer->birth }}</td>
                <td>{{ $reviewer->gender }}</td>
                <td>{{ $reviewer->receive_agreement }}</td>
                <td>{{ $reviewer->created_at }}</td>
                <td>{{ $reviewer->updated_at }}</td>
                <td>{{ $reviewer->point }}</td>
                <td>
                    @if($reviewer->channelreviewers->count())
                    <a class="sns" data-id="{{$reviewer->id}}" href="">sns보기</a>
                    @else
                    없음
                    @endif
                </td>
                <td>
                    @if($reviewer->plan)
                    <a class="plan" data-id="{{$reviewer->plan->id}}" href="">리뷰전략</a>
                    @else
                    미작성
                    @endif
                </td>
                <td>
                    <button class="modi" value="{{$reviewer->id}}">수정</button>
                    <button class="del" value="{{$reviewer->id}}">탈퇴(삭제)</button>
                </td>
            </tr>
        </tbody>
        @empty
        <tr>
            <td colspan=100>리뷰어가 없습니다.</td>
        </tr>
        @endforelse
</table>
{{ $reviewers->links() }}
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
    $('#reviewer_list').on('click', '.del', function(e){
        e.preventDefault();
       var rId = $(this).val();
      if (confirm('해당 리뷰어를 삭제합니다. 삭제 후 복구할 수 없습니다.')) {
        $.ajax({
          type: 'POST',
          url: '/reviewers/' + rId,
            data: {"rId": rId , _method: 'delete'},
        success:function(data){
        }
        }).then(function () {
          window.location.href = "{{route('admin.reviewers')}}";
        });
      }
    });
    //수정클릭
    $('#reviewer_list').on('click', '.modi', function(e){
        e.preventDefault();
       var rId = $(this).val();
        $.ajax({
            type:"get",
          url: '/reviewers/' + rId+'/edit',
        success:function(data){
                $('.popup').html(data.showhtml)
                window.location.hash = '#answer'; 
        }
        });
    });
    
$('.plan').on('click', function(e){
       e.preventDefault();
    var nowId = $(this).data('id');
        $.ajax({
           type:"get",
           url:'/admin/plan/' + nowId,
            success: function(data){
                $('.popup').html(data.showhtml);
                window.location.hash = '#answer'; 
            }
        });
        
    });
    $('.sns').on('click', function(e){
       e.preventDefault();
    var nowId = $(this).data('id');
        $.ajax({
           type:"get",
           url:'/admin/sns/' + nowId,
            success: function(data){
                $('.popup').html(data.showhtml);
                window.location.hash = '#answer'; 
            }
        });
        
    });
    </script>
@endsection