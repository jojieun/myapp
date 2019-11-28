
        @forelse ($waitCampaigns as $waitCampaign)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$waitCampaign->created_at}}</td>
            <td>{{$waitCampaign->name}}</td>
            <td>{{$waitCampaign->brand->name}}</td>
            <td><button class="show" data-id="{{$waitCampaign->id}}">보기</button></td>
        </tr>
        @empty
        <tr>
            <td colspan=100>검수 대기중인 캠페인이 없습니다.</td>
        </tr>
        @endforelse
