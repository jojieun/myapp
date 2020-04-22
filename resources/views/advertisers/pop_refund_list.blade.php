<div class="table_default">
    <div class="table_th">
    <p class="list_date m-w90">날짜</p>
        <p class="list_title2">내역</p>
        <p class="list_point">포인트</p>
    </div>
@forelse($refunds as $refund)
<div class="table_td">
    <div class="table_td_line">
        <p class="list_date m-w90">{{$refund->created_at->format('Y-m-d')}}</p>
        <p class="list_title2">{{$refund->description}}</p>
        <p class="list_point">
            @if($refund->kinds=='i')
            + {{number_format($refund->point)}}
            @else
            - {{number_format($refund->point)}}
            @endif
        </p>
    </div>
</div>
@empty
<div class="table_td">
    <div class="table_td_line">
        포인트 내역이 없습니다.
    </div>
</div>
@endforelse
    </div>