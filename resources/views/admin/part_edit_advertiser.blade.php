    <form method="post" action="{{route('advertisers.update',$advertiser->id)}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <table>
        <tr>
            <th>이메일</th>
            <td>
                {{$advertiser->email}}
            </td>
        </tr>
            <tr>
            <th>이름</th>
            <td>
            <input name="name" value="{{ old('name', $advertiser->name) }}">
            </td>
        </tr>
        <tr>
            <th>전화번호</th>
            <td>
            <input name="mobile_num" value="{{ old('mobile_num', $advertiser->mobile_num) }}" type="tel">
            </td>
        </tr>
            <tr>
            <th>포인트</th>
            <td>
            <input name="point" value="{{ old('point', $advertiser->point) }}" type="tel">
            </td>
        </tr>
    </table>
        <button type="submit">수정입력</button>
    </form>
<a href="#close" class="close"></a>
