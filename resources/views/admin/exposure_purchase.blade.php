@extends('admin.layout.main')
@section('content')
<h1>캠페인 노출옵션 구매내역</h1>
<table>
    <thead>
        <tr>
            <th>번호</th>
            <th>노출옵션</th>
            <th>캠페인명</th>
<!--
            <th>노출시작</th>
            <th>노출끝</th>
-->
            <th>구매일</th>
            <th>처리</th>
        </tr>
    </thead>
    <tbody id="list">
        @include('admin.part_exposure_purchase')
    </tbody>
</table>
<script>

</script>
@endsection