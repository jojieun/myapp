@extends('admin.layout.main')
@section('content')
    <h1>리뷰어 회원 목록</h1>
    <table>
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
                <th>마지막로그인</th>
                <th>가입일</th>
                <th>정보수정일</th>
                <th>포인트</th>
                <th>sns</th>
                <th>리뷰전략</th>
            </tr>
        </thead>
        @forelse ($reviewers as $reviewer)
        <tbody>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $reviewer->email }}</td>
                <td>{{ $reviewer->name }}</td>
                <td>{{ $reviewer->nickname }}</td>
                <td>{{ $reviewer->mobile_num }}</td>
                <td>[{{ $reviewer->zipcode }}] {{ $reviewer->address }} {{ $reviewer->detail_address }}</td>
                <td>{{ $reviewer->birth }}</td>
                <td>{{ $reviewer->gender }}</td>
                <td>{{ $reviewer->receive_agreement }}</td>
                <td>{{ $reviewer->last_login }}</td>
                <td>{{ $reviewer->created_at }}</td>
                <td>{{ $reviewer->updated_at }}</td>
                <td>{{ $reviewer->point }}</td>
                <td>
                    @if(isset($reviewer->channelreviewers))
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