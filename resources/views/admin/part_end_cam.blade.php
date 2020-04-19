
        @forelse ($end_cams as $end_cam)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$end_cam->name}}</td>
            <td>{{$end_cam->brand->name}}</td>
            <td>{{$end_cam->end_submit}}</td>
            <td>{{$end_cam->campaign_reviewers_count}}</td>
            <td>{{$end_cam->reviews_count}}</td>
        </tr>
        @empty
        <tr>
            <td colspan=100>완료된 캠페인이 없습니다.</td>
        </tr>
        @endforelse
