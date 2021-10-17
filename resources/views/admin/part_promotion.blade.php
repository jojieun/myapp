        @forelse ($promotions as $promotion)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $promotion->name }}</td>
            <td>{{ $promotion->price }}</td>
            <td>{{ $promotion->limit }}</td>
            <td>{{ $promotion->instruction }}</td>
            <td>{{ $promotion->fee_waiver }}</td>
            <td>
                <button class="edit" value="{{ $promotion->id }}">수정</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan=100>노출옵션이 없습니다.</td>
        </tr>
        @endforelse
