@extends('admin.layout.main')
@section('content')
    <h1>완료 캠페인목록</h1>
    <table>
        <thead>
        <tr>
            <th>번호</th>
            <th>캠페인명</th>
            <th>브랜드명</th>
            <th>리뷰제출마감일</th>
            <th>선정인원</th>
            <th>리뷰제출인원</th>
        </tr>
            </thead>
        <tbody id="list">
            @include('admin.part_end_cam')
            </tbody>
</table>
@endsection