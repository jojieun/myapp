
        @forelse ($recruitCampaigns as $recruitCampaign)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$recruitCampaign->name}}</td>
            <td>{{$recruitCampaign->brand->name}}</td>
            <td>{{$recruitCampaign->start_recruit}}</td>
            <td>{{$recruitCampaign->end_recruit}}</td>
            <td>{{$recruitCampaign->recruit_number}}</td>
            <td><button data-r="{{$recruitCampaign->id}}" class="show">{{$recruitCampaign->campaign_reviewers_count}}</button></td>
            <td>
                <?
                if ($recruitCampaign->campaignexposure)
                $eId = $recruitCampaign->campaignexposure->exposure_id;
                else
                $eId = 9;
                    ?>
                <form method="post" action="{{route('admin.exposure_purchase_make',$recruitCampaign->id)}}">
                {!! csrf_field() !!}
                <select name="exposure_id">
                    <option value="">없음</option>
                    @foreach($exposures as $exposure)
                    <option value="{{$exposure->id}}" @if($exposure->id==$eId) selected @endif >{{$exposure->name}}</option>
                    @endforeach
                </select>
                <button type="submit">수정</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan=100>리뷰어 모집중인 캠페인이 없습니다.</td>
        </tr>
        @endforelse
