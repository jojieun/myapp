    <form id="edit_promotion" method="POST" action="{{route('admin.update_promotion',$promotion->id)}}">
        {!! method_field('PUT') !!}
        {!! csrf_field() !!}
        <table>
            <tr>
                <th>옵션명</th>
                <td>
                    <input name="name" value="{{ old('name', $promotion->name) }}">
                </td>
            </tr>
            <tr>
                <th>가격</th>
                <td>
                    <input name="price" value="{{ old('price', $promotion->price) }}">
                </td>
            </tr>
            <tr>
                <th>신청가능개수</th>
                <td>
                    <input name="limit" value="{{ old('limit', $promotion->limit) }}">
                </td>
            </tr>
            <tr>
                <th>옵션설명</th>
                <td>
                    <textarea rows="4" name="instruction">{{ old('instruction', $promotion->instruction) }}</textarea>
                </td>
            </tr>
            <tr>
                <th>수수료면제인원</th>
                <td>
                    <input name="fee_waiver" value="{{ old('fee_waiver', $promotion->fee_waiver) }}">
                </td>
            </tr>
        </table>
        <button type="submit">수정</button>
    </form>
    <a href="#close" class="close"></a>