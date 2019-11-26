    <form id="answer" type="post">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <table>
    `   <tr>
            <th>제목</th>
        <td>
            <input name="title"  value="{{ old('title', $notice->title) }}">
            </td>
        </tr>
        <tr>
            <th>내용</th>
        <td><textarea name="content" rows="5">{{ old('content', $notice->content) }}</textarea></td>
        </tr> 
    </table>
        <button data-id="{{ old('id', $notice->id) }}" id="modal_submit">수정입력</button>
    </form>
<a href="#close" class="close"></a>
