
        @forelse ($black_lists as $black_list)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$black_list->reviewer->email}}</td>
            <td>{{$black_list->reviewer->name}}</td>
            <td>{{$black_list->reviewer->mobile_num}}</td>
            <td>{{$black_list->campaign->name}}</td>
            <td>{{$black_list->campaign->end_submit}}</td>
        </tr>
        @empty
        <tr>
            <td colspan=100>미제출 리뷰어(블랙리스트)가 없습니다.</td>
        </tr>
        @endforelse
