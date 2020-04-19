
        @forelse ($recruitCampaigns as $recruitCampaign)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$recruitCampaign->name}}</td>
            <td>{{$recruitCampaign->brand->name}}</td>
            <td>{{$recruitCampaign->start_recruit}}</td>
            <td>{{$recruitCampaign->end_recruit}}</td>
            <td>{{$recruitCampaign->recruit_number}}</td>
            <td><button data-r="{{$recruitCampaign->id}}" class="show">{{$recruitCampaign->campaign_reviewers_count}}</button></td>
        </tr>
        @empty
        <tr>
            <td colspan=100>리뷰어 모집중인 캠페인이 없습니다.</td>
        </tr>
        @endforelse
