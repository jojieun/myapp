@extends('layouts.main')
@section('content')

<!-- 왼쪽메뉴 -->
@include('reviewers.reviewer_leftmenu')

<!-- 오른쪽 컨텐츠 -->
<div class="right-content">
    <h2 class="mb70 m-text-left">출금신청</h2>

    <form method="post" action="{{ route('reviewers.save_withdraw') }}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="table_form2 my-point">
            <dl>
                <dt>입금은행</dt>
                <dd>
                    <select name="bank_id" type="text" id="" class="full_width">
                        <option value="" selected disabled hidden>선택해주세요.</option>
                        @foreach($banks as $bank)
                        <option value="{{$bank->id}}">{{$bank->name}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('bank_id','<span class="red">:message</span>')!!}
                </dd>
            </dl>
            <dl>
                <dt>예금주</dt>
                <dd><input name="account_holder" type="text" id="" value="{{ old('account_holder') }}" placeholder=" " class="full_width" />
                {!! $errors->first('account_holder','<span class="red">:message</span>')!!}</dd>
            </dl>
            <dl>
                <dt>계좌 번호</dt>
                <dd><input name="account_number" type="text" id="" value="{{ old('account_number') }}" placeholder="‘-’ 없이 입력해주세요" class="full_width" />
                {!! $errors->first('account_number','<span class="red">:message</span>')!!}</dd>
            </dl>
            <dl class="bar">
                <dt>신분증 사본</dt>
                <dd>
                    <div class="file-area">
                        <span class="upload2">
                            <label for="file1"><input name="id_card_image" type="file" id="file1" value="" placeholder="신분증 사본" class="mb10" /></label>
                        </span>
                    </div>
                    {!! $errors->first('id_card_image','<span class="red">:message</span>')!!}
                </dd>
            </dl>
            <dl>
                <dt>출금포인트</dt>
                <dd class="out-point">
                    <input name="amount" type="number" id="" value="{{ old('amount') }}" placeholder="출금하실 포인트를 입력해주세요" class="full_width" max="{{$user->point}}"/><span>point</span>
                    <p>출금가능 포인트 <b>{{number_format($user->point)}}</b>P</p>
                    <small>(최소 10,000P 이상 출금가능)</small>
                </dd>
            </dl>
            <dl>
                <dt>지급예정금액</dt>
                <dd class="total-point">
                    <p class="total-view"><b id="total_amount">0</b>원</p>
                    <p class="table_add_txt2">수수료 3.3%와 이체수수료가 공제된 금액입니다.</p>
                </dd>
            </dl>
        </div>

        <div class="join_btn_wrap">
            <a href="{{route('reviewers.point')}}" class="btn">취소</a>
            <button type="submit" class="btn black">출금신청</button>
        </div>
    </form>
    <!-- //리뷰전략 등록 -->
</div>
</div>
<!-- //상세 컨텐츠내용 -->
</div>
@include('reviewers.reviewer_bottommenu')

<!--최소출금금액 알림-->
@component('help.popup_ok')
@slot('goId')
min_amount
@endslot
최소 10,000원 이상 출금가능합니다.
@endcomponent
<!--포인트보다 출금금액 많음 알림-->
@component('help.popup_ok')
@slot('goId')
over_point
@endslot
출금포인트가 출금가능포인트보다 많습니다.
@endcomponent

<script>
$('input[name=amount]').blur(function(){
   var amount = $(this).val();
    if(amount>{!! $user->point !!}){
        location.hash = 'over_point';
    } else if(amount<10000) {
        location.hash = 'min_amount';
    } else {
        $('#total_amount').html(amount*0.967-500);
    }
});
</script>

@endsection