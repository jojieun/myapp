    <table>
        <colgroup>
            <col width="1*">
            <col width="4*">
            <col width="4*">
        </colgroup>
        <tr>
            <th>목록</th>
            <th>수정</th>
            <th>원본</th>
        </tr>
        <tr>
            <th>광고주</th>
            <td colspan="2">{{$campaign->advertiser->name}}</td>
        </tr>
        <tr>
            <th>작성일</th>
            <td>{{$modify_campaign->created_at}}</td>
            <td>{{$campaign->created_at}}</td>
        </tr>
        <tr>
            <th>진행형태</th>
            <td>@if($modify_campaign->form=='v')재택@else방문@endif</td>
            <td>@if($campaign->form=='v')재택@else방문@endif</td>
        </tr>
        <tr>
            <th>브랜드명</th>
            <td>{{$modify_campaign->brand->name}}</td>
            <td>{{$campaign->brand->name}}</td>
        </tr>
        <tr>
            <th>카테고리</th>
            <td>{{$modify_campaign->brand->category->name}}</td>
            <td>{{$campaign->brand->category->name}}</td>
        </tr>
        <tr>
            <th>캠페인명</th>
            <td>{{$modify_campaign->name}}</td>
            <td>{{$campaign->name}}</td>
        </tr>
        <tr>
            <th>모집인원</th>
            <td>{{$modify_campaign->recruit_number}}</td>
            <td>{{$campaign->recruit_number}}</td>
        </tr>
        <tr>
            <th>제공포인트</th>
            <td>{{$modify_campaign->offer_point}}</td>
            <td>{{$campaign->offer_point}}</td>
        </tr>
        <tr>
            <th>제공물품</th>
            <td>{{$modify_campaign->offer_goods }}</td>
            <td>{{$campaign->offer_goods }}</td>
        </tr>
        <tr>
            <th>모집채널</th>
            <td>{{$modify_campaign->channel->name}}</td>
            <td>{{$campaign->channel->name}}</td>
        </tr>
        <tr>
            <th>모집시작일</th>
            <td>{{$modify_campaign->start_recruit }}</td>
            <td>{{$campaign->start_recruit }}</td>
        </tr>
        <tr>
            <th>모집마감일</th>
            <td>{{$modify_campaign->end_recruit }}</td>
            <td>{{$campaign->end_recruit }}</td>
        </tr>
        <tr>
            <th>제출마감일</th>
            <td>{{$modify_campaign->end_submit }}</td>
            <td>{{$campaign->end_submit }}</td>
        </tr>
        <tr>
            <th>대표이미지</th>
            <td>
                <img src="/files/{{$modify_campaign->main_image }}" width="300">
            </td>
            <td>
                <img src="/files/{{$campaign->main_image }}" width="300">
            </td>
        </tr>
        <tr>
            <th>상세이미지</th>
            <td>
                @if($modify_campaign->sub_image1 )
                <img src="/files/{{$modify_campaign->sub_image1 }}" width="300">
                @endif
                @if($modify_campaign->sub_image2 )
                <img src="/files/{{$modify_campaign->sub_image2 }}" width="300">
                @endif
                @if($modify_campaign->sub_image3 )
                <img src="/files/{{$modify_campaign->sub_image3 }}" width="300">
                @endif
            </td>
            <td>
                @if($campaign->sub_image1 )
                <img src="/files/{{$campaign->sub_image1 }}" width="300">
                @endif
                @if($campaign->sub_image2 )
                <img src="/files/{{$campaign->sub_image2 }}" width="300">
                @endif
                @if($campaign->sub_image3 )
                <img src="/files/{{$campaign->sub_image3 }}" width="300">
                @endif
            </td>
        </tr>
        <tr>
            <th>담당자연락처</th>
            <td>{{$modify_campaign->contact}}</td>
            <td>{{$campaign->contact}}</td>
        </tr>
        <tr>
            <th>리뷰미션</th>
            <td>{{$modify_campaign->mission }}</td>
            <td>{{$campaign->mission }}</td>
        </tr>
        <tr>
            <th>리뷰키워드</th>
            <td>{{$modify_campaign->keyword}}</td>
            <td>{{$campaign->keyword}}</td>
        </tr>
        @if($modify_campaign->form=='v')
        <tr>
            <th>지역</th>
            <td>{{$modify_campaign->area->region->name}} {{$modify_campaign->area->name}}</td>
            <td>@if($campaign->form=='v'){{$campaign->area->region->name}} {{$campaign->area->name}}@endif</td>
        </tr>
        <tr>
            <th>방문가능시간</th>
            <td>{{$modify_campaign->visit_time }}</td>
            <td>@if($campaign->form=='v'){{$campaign->visit_time }}@endif</td>
        </tr>
        <tr>
            <th>주소</th>
            <td>[{{$modify_campaign->zipcode }}]
            {{$modify_campaign->address  }}
                {{$modify_campaign->detail_address  }}
            </td>
            <td>@if($campaign->form=='v')[{{$campaign->zipcode }}]
            {{$campaign->address }}
                {{$campaign->detail_address  }}@endif
            </td>
        </tr>
        @endif
        <tr>
            <td colspan="3" class="last"><button class="confirm" value="{{$modify_campaign->id}}" data-r="a">수정승인</button>
                <button class="confirm" value="{{$modify_campaign->id}}" data-r="r">반려</button></td>
        </tr>
    </table>

<a href="#close" class="close"></a>
