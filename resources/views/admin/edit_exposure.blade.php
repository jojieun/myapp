    <form id="edit_exposure" method="POST" action="{{route('admin.update_exposure',$exposure->id)}}">
        {!! method_field('PUT') !!}
        {!! csrf_field() !!}
        <table>
            <tr>
                <th>옵션명</th>
                <td>
                    <input name="name" value="{{ old('name', $exposure->name) }}">
                </td>
            </tr>
            <tr>
                <th>가격</th>
                <td>
                    <input name="price" value="{{ old('price', $exposure->price) }}">
                </td>
            </tr>
            <tr>
                <th>신청가능개수</th>
                <td>
                    <input name="limit" value="{{ old('limit', $exposure->limit) }}">
                </td>
            </tr>
            <tr>
                <th>옵션설명</th>
                <td>
                    <textarea rows="4" name="instruction">{{ old('instruction', $exposure->instruction) }}</textarea>
                </td>
            </tr>
            <tr>
                <th>수수료면제인원</th>
                <td>
                    <input name="fee_waiver" value="{{ old('fee_waiver', $exposure->fee_waiver) }}">
                </td>
            </tr>
        </table>
        <button type="submit">수정</button>
    </form>
    <a href="#close" class="close"></a>