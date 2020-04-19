        @forelse ($promotion_purchases as $promotion_purchase)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $promotion_purchase->promotion->name }}</td>
            <td>{{ $promotion_purchase->campaign->name }}</td>
<!--
            <td>{{ $promotion_purchase->start }}</td>
            <td>{{ $promotion_purchase->end }}</td>
-->
            <td>{{ $promotion_purchase->created_at }}</td>
            <td>@if($promotion_purchase->process) 처리됨 @else 
             <button type="button" class="process" onclick="window.location='/admin/promotion_purchase_update/{{$promotion_purchase->id}}';">처리확인</button> @endif</td>
        </tr>
        @empty
        <tr>
            <td colspan=100>노출옵션이 없습니다.</td>
        </tr>
        @endforelse
