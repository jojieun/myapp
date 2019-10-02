@extends('layouts.main')

@section('content')
<a href="{{route('reviewers.create')}}">리뷰어회원 가입하기</a>
<a href="{{route('advertisers.create')}}">광고주회원 가입하기</a>
@endsection