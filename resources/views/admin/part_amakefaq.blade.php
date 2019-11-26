    <form id="answer" type="post">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <table>
            <tr>
                <th>카테고리</th>
                <td>
                    <select name="cate">
                        @forelse($afcategories as $afcategory)
                        <option value="{{$afcategory->id}}" @if($afcategory->id==$advertiserfaq->aFAQcategory->id) selected @endif>{{$afcategory->name}}</option>
                        @empty
                        <option value="">카테고리가 없습니다</option>
                        @endforelse
                    </select>
                </td>
            </tr>
    `   <tr>
            <th>질문</th>
        <td>
            <input name="question"  value="{{ old('question', $advertiserfaq->question) }}">
            </td>
        </tr>
        <tr>
            <th>답변</th>
        <td><textarea name="answer" rows="5">{{ old('answer', $advertiserfaq->answer) }}</textarea></td>
        </tr> 
    </table>
        <button data-id="{{ old('id', $advertiserfaq->id) }}" id="modal_submit">수정입력</button>
    </form>
<a href="#close" class="close"></a>
