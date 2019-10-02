@extends('layouts.main')
@section('content')

<form action="{{ route('reviewers.store') }}" method="post" class="form__auth">
{!! csrf_field() !!}
    <div id="register_wrap">
        <div class="register_box">
            <h1>약관동의</h1>
            <div class="">
                <input type="checkbox" id="all_check">전체동의
            </div>
            <div class="">
                <input type="checkbox" name="terms1" class="terms">필수약관1
            </div>
            <div class="">
                <input type="checkbox" name="terms2" class="terms">필수약관2
            </div>
            <div class="">
                <input type="checkbox" name="terms3" class="terms">필수약관3
            </div>
            <div class="">
                <input type="hidden" value="0" name="receive_agreement" />
                <input type="checkbox" name="receive_agreement" id="receive_agreement" class="terms" value="1">선택약관
            </div>
            <h1>sns</h1>
            <div class="">
                <input type="text" placeholder="네이버블로그" name="naver_blog" value="{{ old('naver_blog') }}">
            </div>
            <div class="">
                <input type="text" placeholder="네이버포스트" name="naver_post" value="{{ old('naver_post') }}">
            </div>
            <div class="">
                <input type="text" placeholder="인스타그램" name="instagram" value="{{ old('instagram') }}">
            </div>
            <div class="">
                <input type="text" placeholder="유튜브" name="youtube" value="{{ old('youtube') }}">
            </div>
            <div class="">
                <input type="text" placeholder="페이스북" name="facebook" value="{{ old('facebook') }}">
            </div>
            <div class="">
                <input type="text" placeholder="페이스북" name="kakao" value="{{ old('kakao') }}">
            </div>
            <input type="button" id="next" value="다음">
        </div>
<!--        .register_box-->
        <div class="register_box">
            <h1>필수정보</h1>
            <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="email" name="email" placeholder="이메일" value="{{old('email')}}">
                {!! $errors->first('email','<span>:message</span>')!!}
            </div>
            <div class="{{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password" placeholder="비밀번호">
                {!! $errors->first('password','<span>:message</span>')!!}
            </div>
            <div class="{{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password_confirmation" placeholder="비밀번호재확인">
                {!! $errors->first('password_confirmation','<span>:message</span>')!!}
            </div>
            <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="text" name="name" placeholder="이름" value="{{old('name')}}">
                {!! $errors->first('name','<span>:message</span>')!!}
            </div>
            <div class="{{ $errors->has('nickname') ? 'has-error' : '' }}">
                <input type="text" name="nickname" placeholder="닉네임" value="{{old('nickname')}}">
                {!! $errors->first('nickname','<span>:message</span>')!!}
            </div>
            <div class="{{ $errors->has('birth') ? 'has-error' : '' }}">
                <input type="date" name="birth" placeholder="생년월일" value="{{old('birth')}}">
                {!! $errors->first('birth','<span>:message</span>')!!}
            </div>
            <div class="{{ $errors->has('mobile_num') ? 'has-error' : '' }}">
                <input type="tel" name="mobile_num" placeholder="휴대폰번호 '-'없이 숫자만 입력해주세요!" value="{{old('mobile_num')}}">
                {!! $errors->first('mobile_num','<span>:message</span>')!!}
            </div>
            <div class="{{ $errors->has('zipcode') ? 'has-error' : '' }}">
                <input type="text" name="zipcode" placeholder="우편번호" value="{{old('zipcode')}}">
                {!! $errors->first('zipcode','<span>:message</span>')!!}
            </div>
            <div class="{{ $errors->has('address') ? 'has-error' : '' }}">
                <input type="text" name="address" placeholder="주소" value="{{old('address')}}">
                {!! $errors->first('address','<span>:message</span>')!!}
            </div>
            <div class="{{ $errors->has('detail_address') ? 'has-error' : '' }}">
                <input type="text" name="detail_address" placeholder="상세주소" value="{{old('detail_address')}}">
                {!! $errors->first('detail_address','<span>:message</span>')!!}
            </div>
            <div class="">
                성별
                <input type="radio" name="gender" value="f" @if(old('gender')=='f') checked @endif>여자
                <input type="radio" name="gender" value="m" @if(old('gender')=='m') checked @endif>남자
            </div>
            <div class="">
                <button type="submit">가입하기</button>
            </div>
        </div>
    </div>
<!--    #register_wrap-->
</form>
@endsection