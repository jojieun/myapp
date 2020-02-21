        @forelse ($exposures as $exposure)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $exposure->name }}</td>
            <td>{{ $exposure->price }}</td>
            <td>{{ $exposure->limit }}</td>
            <td>
                <button class="edit" value="{{ $advertiserfaq->id }}">수정</button>
                <button class="del" value="{{ $advertiserfaq->id }}">삭제</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan=100>노출옵션이</td>
        </tr>
        @endforelse
