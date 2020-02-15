@extends('admin.layout.main')
@section('content')
    <h1>포인트 출금신청내역</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>신청자명</th>
            <th>신청자연락처</th>
            <th>은행</th>
            <th>계좌번호</th>
            <th>예금주</th>
            <th>신청포인트</th>
            <th>이체금액</th>
            <th>완료일</th>
            <th>신분증사본</th>
        </tr>
        </thead>
        <tbody id="list">
            @forelse ($complete_deposits as $complete_deposit)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $complete_deposit->reviewer->name }}</td>
            <td>{{ $complete_deposit->reviewer->mobile_num }}</td>
            <td>{{ $complete_deposit->bank->name }}</td>
            <td>{{ $complete_deposit->account_number }}</td>
            <td>{{ $complete_deposit->account_holder }}</td>
            <td>{{ $complete_deposit->amount }}</td>
            <td>{{ $complete_deposit->amount * 0.967 - 500 }}</td>
            <td>{{ $complete_deposit->updated_at }}</td>
            <td><button class="show" data-i="{{ $complete_deposit->id_card_image }}">보기</button></td>
        </tr>
        @empty
        <tr>
            <td colspan=100>출금완료 내역이 없습니다</td>
        </tr>
        @endforelse
        </tbody>
</table>
<a href="#close" class="overlay" id="pic"></a>
<div class="popup">
<img id="pic_in" src="" width="100%">
<a href="#close" class="close"></a>
</div>

<script>
$('.show').click(function(e){
    $('#pic_in').attr({
        src:'/files/id_card/'+$(this).data('i')
    })
    window.location.hash = '#pic';
        });
    </script>
@endsection