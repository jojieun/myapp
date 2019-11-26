        @forelse ($notices as $notice)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $notice->title }}</td>
            <td>{{ $notice->updated_at }}</td>
            <td>
                <button class="edit" value="{{ $notice->id }}">수정</button>
                <button class="del" value="{{ $notice->id }}">삭제</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan=100>공지사항이 없습니다</td>
        </tr>
        @endforelse
