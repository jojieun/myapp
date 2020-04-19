
        @forelse ($submit_cams as $submit_cam)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$submit_cam->name}}</td>
            <td>{{$submit_cam->brand->name}}</td>
            <td>{{$submit_cam->end_submit}}</td>
            <td><button data-r="{{$submit_cam->id}}" class="show">{{$submit_cam->campaign_reviewers_count}}</button></td>
            <td>@if($submit_cam->send_sms) O @else X @endif</td>
        </tr>
        @empty
        <tr>
            <td colspan=100>리뷰 진행중인 캠페인이 없습니다.</td>
        </tr>
        @endforelse
