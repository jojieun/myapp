@extends('admin.layout.main')
@section('content')
    <h1>리뷰어 회원 목록</h1>
    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th colspan="2">이메일</th>
                <th>이름</th>
                <th>닉네임</th>
                <th>전화번호</th>
                <th>생년월일</th>
                <th colspan="4">주소</th>
                <th>성별</th>
            </tr>
            <tr>
                <th>네이버블로그</th>
                <th>네이버포스트</th>
                <th>인스타그램</th>
                <th>유튜브</th>
                <th>페이스북</th>
                <th>카카오스토리</th>
                <th>메일,sns수신동의</th>
                <th>마지막로그인</th>
                <th>가입일</th>
                <th>가입정보수정일</th>
                <th>포인트</th>
                <th>리뷰전략</th>
            </tr>
        </thead>
        @forelse ($reviewers as $reviewer)
        <tbody>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td colspan="2">{{ $reviewer->email }}</td>
                <td>{{ $reviewer->name }}</td>
                <td>{{ $reviewer->nickname }}</td>
                <td>{{ $reviewer->mobile_num }}</td>
                <td>{{ $reviewer->birth }}</td>
                <td colspan="4">[{{ $reviewer->zipcode }}] {{ $reviewer->address }} {{ $reviewer->detail_address }}</td>
                <td>{{ $reviewer->gender }}</td>
            </tr>
            <tr>
                <td>{{ $reviewer->naver_blog }}</td>
                <td>{{ $reviewer->naver_post }}</td>
                <td>{{ $reviewer->instagram }}</td>
                <td>{{ $reviewer->youtube }}</td>
                <td>{{ $reviewer->facebook }}</td>
                <td>{{ $reviewer->kakao }}</td>
                <td>{{ $reviewer->receive_agreement }}</td>
                <td>{{ $reviewer->last_login }}</td>
                <td>{{ $reviewer->created_at }}</td>
                <td>{{ $reviewer->updated_at }}</td>
                <td>{{ $reviewer->point }}</td>
                <td>
                    @if($reviewer->plan)
                    <a href="{{route('admin.plan',[$reviewer->plan->id])}}">리뷰전략</a>
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