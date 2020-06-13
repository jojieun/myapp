@extends('admin.layout.out')
@section('content')
		<h1 class="m-text-left">관리자로그인
		</h1>
		<div class="login_wrap">
			<form action="{{ route('admin.loginstore') }}" method="post" class="form__auth">
                    {!! csrf_field() !!}
                   @include('flash::message')
				<div class="login-group">
					<p class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						<label for="">이메일</label>
                           <input type="email" name="email" class="form-control full_width" placeholder="이메일을 입력해주세요." value="{{ old('email') }}" autofocus/>
                           {!! $errors->first('email', '<span class="red">:message</span>') !!}
					</p>
					<p class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
						<label for="">비밀번호</label>
                           <input type="password" name="password" maxlength="20" class="form-control full_width" placeholder="비밀번호를 입력해주세요.">
                           {!! $errors->first('password', '<span class="red">:message</span>')!!}
					</p>
                       <p>
                       <button type="submit">로그인</button>
                       </p>
				</div>
			</form> 
		</div>
<hr>
<a href="{{route('admins.create')}}">새 관리자 생성</a>
@endsection