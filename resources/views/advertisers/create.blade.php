@extends('layouts.main')
@section('content')

<form action="{{ route('advertisers.store') }}" method="post" class="form__auth">
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
            <div class="{{ $errors->has('category_id') ? 'has-error' : '' }}">
                <select name="category_id">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('category_id','<span>:message</span>')!!}
            </div>
           <div class="{{ $errors->has('brand_name') ? 'has-error' : '' }}">
                <input type="text" name="brand_name" placeholder="브랜드명" value="{{old('brand_name')}}">
                {!! $errors->first('brand_name','<span>:message</span>')!!}
            </div>
             <div class="{{ $errors->has('mobile_num') ? 'has-error' : '' }}">
                <input type="tel" name="mobile_num" placeholder="휴대폰번호 '-'없이 숫자만 입력해주세요!" value="{{old('mobile_num')}}">
                {!! $errors->first('mobile_num','<span>:message</span>')!!}
            </div>
            <div class="">
                <button type="submit">가입하기</button>
            </div>
        </div>
    </div>
<!--    #register_wrap-->
</form>
@endsection