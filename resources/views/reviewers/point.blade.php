@extends('layouts.main')
@section('content')

<!-- 왼쪽메뉴 -->
@include('reviewers.reviewer_leftmenu')

<!-- 오른쪽 컨텐츠 -->
<div class="right-content">
    <div class="my-point-top">
        <dl>
            <dt><b>나의포인트</b></dt>
            <dd>
                <span class="title">{{$user->nickname}}님의 보유포인트</span>
                <span class="point"><b>{{number_format($user->point)}}</b>P<a href="{{ route('reviewers.withdraw') }}">출금신청</a></span>
            </dd>
        </dl>
    </div>

    <div class="my-point-search">
        <p class="search-date">
            <span class="title">기간</span>
            <span class="txt">
                <input name="start" type="date" size="20" title="시작일" class="m_mb10 input-date" /> ~
                <input name="end" type="date" size="20" title="종료일" class="m_mb10 input-date" max="{{ date('Y-m-d', strtotime('now')) }}"/>
            </span>
        </p>
        <p class="search-select">
            <span class="title m-dp-b">유형</span>
            <select name="kinds" id="">
                <option value="">전체</option>
                <option value="d">받은포인트</option>
                <option value="w">출금포인트</option>
            </select>
        </p>
    </div>

    <!-- 검색 -->
<!--
    <div class="board_navi_box list">
        <span class="search mr0">
            <input name="find" type="text" placeholder="검색어를 입력해주세요"><a id="find"><img src="/img/common/ico_search.gif" alt="검색"></a>
        </span>
    </div>
-->
    <!-- //검색 -->
    <!-- 나의포인트 -->
    <div class="table_default review-info">
        <div class="table_th">
            <p class="list_date m-w90">날짜</p>
            <p class="list_title2">내역</p>
            <p class="list_point m-w90">거래유형</p>
            <p class="list_point">포인트</p>
        </div>
        <div id="part_point">
            @include('reviewers.part_point');
        </div>
    </div>
</div>
</div>
<!-- //상세 컨텐츠내용 -->
</div>
@include('reviewers.reviewer_bottommenu')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var start, end, kinds;
    //검색
    function pointSearch(){
        start = $('input[name=start]').val();
        myend = $('input[name=end]').val();
        kinds = $('select[name=kinds]').val();
//        find = $('input[name=find]').val();
        $.ajax({
                type: "POST",
                url: "{{ route('reviewers.point_search') }}",
                data: {
                    start:start,
                    myend:myend,
                    kinds:kinds,
//                    find:find
                },
                success: function(data) {
                    $('#part_point').html(data.showhtml);
                },
                error: function(data) {
                    alert('검색에 문제가 있습니다. 고객센터에 연락주세요!')
                },
            });
    }
    //검색조건 변경시
    $('input[type=date], select[name=kinds]').change(function() {
        pointSearch();
    });
    
//    $('#find').click(function(e) {
//        e.preventDefault();
//        pointSearch();
//    });
</script>

@endsection