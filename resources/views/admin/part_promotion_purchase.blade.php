        @forelse ($promotion_purchases as $promotion_purchase)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $promotion_purchase->promotion->name }}</td>
            <td>{{ $promotion_purchase->campaign->name }}</td>
            <td>{{ $promotion_purchase->start }}</td>
            <td>{{ $promotion_purchase->end }}</td>
            <td>{{ $promotion_purchase->created_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan=100>노출옵션이 없습니다.</td>
        </tr>
        @endforelse
