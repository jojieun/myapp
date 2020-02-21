        @forelse ($exposure_purchases as $exposure_purchase)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $exposure_purchase->exposure->name }}</td>
            <td>{{ $exposure_purchase->campaign->name }}</td>
            <td>{{ $exposure_purchase->start }}</td>
            <td>{{ $exposure_purchase->end }}</td>
            <td>{{ $exposure_purchase->created_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan=100>노출옵션이 없습니다.</td>
        </tr>
        @endforelse
