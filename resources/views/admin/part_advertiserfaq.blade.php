        @forelse ($advertiserfaqs as $advertiserfaq)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $advertiserfaq->aFAQcategory->name }}</td>
            <td>{{ $advertiserfaq->question }}</td>
            <td>{{ $advertiserfaq->updated_at }}</td>
            <td>
                <button class="edit" value="{{ $advertiserfaq->id }}">수정</button>
                <button class="del" value="{{ $advertiserfaq->id }}">삭제</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan=100>광고주 FAQ가 없습니다.</td>
        </tr>
        @endforelse
