
        @forelse ($modify_campaigns as $modify_campaign)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$modify_campaign->created_at}}</td>
            <td>{{$modify_campaign->name}}</td>
            <td>{{$modify_campaign->brand->name}}</td>
            <td><button class="show" data-id="{{$modify_campaign->id}}" data-camid="{{$modify_campaign->campaign_id}}">보기</button></td>
        </tr>
        @empty
        <tr>
            <td colspan=100>수정 요청중인 캠페인이 없습니다.</td>
        </tr>
        @endforelse
