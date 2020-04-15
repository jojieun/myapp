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
            <td>{{$campaign->name}}</td>
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
            <th>모집시작일</th>
            <td>{{$campaign->start_recruit }}</td>
        </tr>
        <tr>
            <th>모집마감일</th>
            <td>{{$campaign->end_recruit }}</td>
        </tr>
        <tr>
            <th>제출마감일</th>
            <td>{{$campaign->end_submit }}</td>
        </tr>
        <tr>
            <th>대표이미지</th>
            <td>
                <img src="/files/{{$campaign->main_image }}" width="400">
            </td>
        </tr>
        <tr>
            <th>상세이미지</th>
            <td>
                @if($campaign->sub_image1 )
                <img src="/files/{{$campaign->sub_image1 }}" width="400">
                @endif
                @if($campaign->sub_image2 )
                <img src="/files/{{$campaign->sub_image2 }}" width="400">
                @endif
                @if($campaign->sub_image3 )
                <img src="/files/{{$campaign->sub_image3 }}" width="400">
                @endif
            </td>
        </tr>
        <tr>
            <th>담당자연락처</th>
            <td>{{$campaign->contact}}</td>
        </tr>
        <tr>
            <th>리뷰미션</th>
            <td>{{$campaign->mission }}</td>
        </tr>
        <tr>
            <th>리뷰키워드</th>
            <td>{{$campaign->keyword}}</td>
        </tr>
        @if($campaign->form=='v')
        <tr>
            <th>지역</th>
            <td>{{$campaign->area->region->name}} {{$campaign->area->name}}</td>
        </tr>
        <tr>
            <th>방문가능시간</th>
            <td>{{$campaign->visit_time }}</td>
        </tr>
        <tr>
            <th>주소</th>
            <td>[{{$campaign->zipcode }}]
            {{$campaign->address  }}
                {{$campaign->detail_address  }}
            </td>
        </tr>
        @endif
        <tr>
            <td colspan="2" class="last"><button class="confirm" value="{{$campaign->id}}">검수하기</button></td>
        </tr>
    </table>

<a href="#close" class="close"></a>
