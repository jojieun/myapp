@extends('admin.layout.main')
@section('content')
    <h1>미제출 리뷰어(블랙리스트)목록</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>이메일</th>
            <th>이름</th>
            <th>전화번호</th>
            <th>미제출캠페인</th>
            <th>캠페인종료일</th>
        </tr>
            </thead>
        <tbody id="list">
            @include('admin.part_black_list')
            </tbody>
</table>
@endsection