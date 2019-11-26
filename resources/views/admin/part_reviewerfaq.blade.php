        @forelse ($reviewerfaqs as $reviewerfaq)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $reviewerfaq->rFAQcategory->name }}</td>
            <td>{{ $reviewerfaq->question }}</td>
            <td>{{ $reviewerfaq->updated_at }}</td>
            <td>
                <button class="edit" value="{{ $reviewerfaq->id }}">수정</button>
                <button class="del" value="{{ $reviewerfaq->id }}">삭제</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan=100>리뷰어 FAQ가 없습니다</td>
        </tr>
        @endforelse
