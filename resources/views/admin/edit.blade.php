@extends('admin.layout.out')
@section('content')
<h1>관리자 정보수정</h1>
<form action="{{ route('admins.update', $admin->id) }}" method="post">
    {!! csrf_field() !!}
    {!! method_field('PUT') !!}
    <table>
        <tr>
            <th>이메일</th>
            <td>{{$admin->email}}</td>
        </tr>
        <tr>
            <th>기존 비밀번호</th>
            <td class="{{ $errors->has('origin_pw') ? 'has-error' : '' }}"><input name="origin_pw" type="password" id="" value="" class="full_width" />{!! $errors->first('origin_pw','<span class="red">:message</span>')!!}</td>
		</tr>
        <tr>
            <th>새 비밀번호</th>
            <td><input type="password" name="password" placeholder="비밀번호(영문과 숫자를 혼합해서 8자 이상)">{!! $errors->first('password','<span class="red">:message</span>')!!}</td>
        </tr>
        <tr>
            <th>새 비밀번호 확인</th>
            <td><input type="password" name="password_confirmation">{!! $errors->first('password_confirmation','<span class="red">:message</span>')!!}</td>
        </tr>
        <tr>
            <th>이름</th>
            <td><input type="text" name="name" value="{{old('name', $admin->name)}}">{!! $errors->first('name','<span class="red">:message</span>')!!}</td>
        </tr>
        <tr>
            <th>전화번호</th>
            <td><input type="tel" name="mobile_num" placeholder="'-'없이 숫자만 입력해주세요!" pattern="(010)\d{7,8}" value="{{old('mobile_num', $admin->mobile_num)}}">{!! $errors->first('mobile_num','<span class="red">:message</span>')!!}</td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit"></td>
        </tr>
    </table>
</form> 
@endsection