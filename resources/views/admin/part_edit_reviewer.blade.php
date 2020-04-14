    <form method="post" action="{{route('reviewers.update',$reviewer->id)}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <table>
        <tr>
            <th>이메일</th>
            <td>
                {{$reviewer->email}}
            </td>
        </tr>
            <tr>
            <th>이름</th>
            <td>
            <input name="name" value="{{ old('name', $reviewer->name) }}">
            </td>
        </tr>
        <tr>
            <th>닉네임</th>
            <td>
            <input name="nickname" value="{{ old('nickname', $reviewer->nickname) }}">
            </td>
        </tr>
        <tr>
            <th>전화번호</th>
            <td>
            <input name="mobile_num" value="{{ old('mobile_num', $reviewer->mobile_num) }}" type="tel">
            </td>
        </tr>
        <tr>
            <th>주소</th>
            <td>
                우편번호 : <input name="zipcode" value="{{ old('zipcode', $reviewer->zipcode) }}">
                <br>
                <input name="address" value="{{ old('address', $reviewer->address) }}">
                <br>
                <input name="detail_address" value="{{ old('detail_address', $reviewer->detail_address) }}">
            </td>
        </tr>
        <tr>
            <th>성별</th>
            <td>
            <input type="radio" name="gender" value="m" @if($reviewer->gender=='m') checked @endif >남
                <input type="radio" name="gender" value="m" @if($reviewer->gender=='f') checked @endif>여
            </td>
        </tr>
    </table>
        <button type="submit">수정입력</button>
    </form>
<a href="#close" class="close"></a>
