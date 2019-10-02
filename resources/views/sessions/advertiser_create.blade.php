@extends('layouts.main')
@section('content')
<h1>로그인</h1>
<form action="{{ route('advertiser_sessions.store') }}" method="post" class="form__auth">
    {!! csrf_field() !!}
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input type="email" name="email" class="form-control" placeholder="이메일" value="{{ old('email') }}" autofocus/>
      {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
      <input type="password" name="password" class="form-control" placeholder="패스워드">
      {!! $errors->first('password', '<span class="form-error">:message</span>')!!}
    </div>
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember" value="{{ old('remember', 1) }}" checked>
          로그인 기억하기
          <span class="text-danger">
            공용 컴퓨터에서는 사용하지 마세요
          </span>
        </label>
      </div>
    </div>
    <div class="form-group">
      <button class="btn btn-primary btn-lg btn-block" type="submit">
        로그인하기
      </button>
    </div>
    <div>
      <p class="text-center">
          <a href="{{ route('advertisers.create') }}">가입하기</a>
      </p>
      <p class="text-center">
        <a href="{{ route('remind.create') }}">비밀번호찾기</a>
      </p>
    </div>
</form>
@endsection