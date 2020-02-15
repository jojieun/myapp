@forelse($points as $point)
<div class="table_td">
    <div class="table_td_line">
        <p class="list_date m-w90">{{$point->created_at->format('Y-m-d')}}</p>
        @if($point->kinds=='w')
        <p class="list_title2">출금</p>
        <p class="list_point m-w90">출금포인트</p>
        <p class="list_point"><b>-{{number_format($point->amount)}}</b></p>
        @else
        <p class="list_title2">{{$point->campaign->name}} 리뷰</p>
        <p class="list_point m-w90">받은포인트</p>
        <p class="list_point"><b class="orange">+{{number_format($point->amount)}}</b></p>
        @endif
    </div>
</div>
@empty
<div class="table_td">
    <div class="table_td_line">
        포인트 입출금 내역이 없습니다.
    </div>
</div>
@endforelse