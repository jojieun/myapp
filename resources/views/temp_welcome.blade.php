@extends('layouts.main')

@section('content')
<div id="temp_wrap">
    <div class="temp_div">
        <img src="img/temp/main_02.png" class="temp_img">
        <a id="temp_btn1" class="btn white big apply_check" style="margin:0 auto;" href="{{route('reviewers.create')}}">신청하기</a>
    </div>
    <div class="temp_div">
        <img src="img/temp/main_03.png" class="temp_img">
    </div>
    <div class="temp_div">
        <img src="img/temp/main_04.png" class="temp_img">
    </div>
    <div class="temp_div">
        <img src="img/temp/main_05.png" class="temp_img">
    </div>
    <div class="temp_div">
        <img src="img/temp/main_06.png" class="temp_img">
    </div>
    <div class="temp_div">
        <img src="img/temp/main_07.png" class="temp_img">
    </div>
    <div class="temp_div">
        <img src="img/temp/main_08.png" class="temp_img">
        <a id="temp_btn2" class="btn black big apply_check" style="margin:0 auto;" href="{{route('reviewers.create')}}">리뷰어 가입하기</a>
    </div>
</div>

@endsection