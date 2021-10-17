        @forelse ($exposures as $exposure)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $exposure->name }}</td>
            <td>{{ $exposure->price }}</td>
            <td>{{ $exposure->limit }}</td>
            <td>{{ $exposure->instruction }}</td>
            <td>{{ $exposure->fee_waiver }}</td>
            <td>
                <button class="edit" value="{{ $exposure->id }}">수정</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan=100>노출옵션이 없습니다.</td>
        </tr>
        @endforelse
