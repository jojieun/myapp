    <form method="post" action="{{route('campaigns.update',$campaign->id)}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <table>
        <tr>
            <th width="100">광고주</th>
            <td>{{$campaign->advertiser->name}}</td>
        </tr>
        <tr>
            <th>작성일</th>
            <td>{{$campaign->created_at}}</td>
        </tr>
        <tr>
            <th>진행형태</th>
            <td>@if($campaign->form=='v')재택@else방문@endif</td>
        </tr>
        <tr>
            <th>브랜드명</th>
            <td>{{$campaign->brand->name}}</td>
        </tr>
        <tr>
            <th>카테고리</th>
            <td>{{$campaign->brand->category->name}}</td>
        </tr>
        <tr>
            <th>캠페인명</th>
            <td>
            <input name="name" value="{{ old('name', $campaign->name) }}">
            </td>
        </tr>
        <tr>
            <th>모집인원</th>
            <td>{{$campaign->recruit_number}}</td>
        </tr>
        <tr>
            <th>제공포인트</th>
            <td>{{$campaign->offer_point}}</td>
        </tr>
        <tr>
            <th>제공물품</th>
            <td>{{$campaign->offer_goods }}</td>
        </tr>
        <tr>
            <th>모집채널</th>
            <td>{{$campaign->channel->name}}</td>
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
