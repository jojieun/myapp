@forelse ($qcategories as $qcategory)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $qcategory->name }}</td>
                <td><button class="del" data-id="{{$qcategory->id}}">삭제</button></td>
            </tr>
        @empty
        <tr>
            <td colspan=100>일대일 문의 카테고리가 없습니다.</td>
        </tr>
        @endforelse