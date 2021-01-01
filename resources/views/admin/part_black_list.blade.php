
        @forelse ($black_lists as $black_list)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$black_list->reviewer->email}}</td>
            <td>{{$black_list->reviewer->name}}</td>
            <td>{{$black_list->reviewer->mobile_num}}</td>
            <td>{{$black_list->campaign->name}}</td>
            <td>{{$black_list->campaign->end_submit}}</td>
            <td style="text-align:right;">{{$black_list->delay}} 일</td>
            <td>@if($black_list->penalty){{$black_list->penalty->fixed_date}}까지 <button class="del" data-id="{{$black_list->penalty->id}}">해제</button>@else<input type="number" class="penalty"> 일 <button class="apply" data-rid={{$black_list->reviewer->id}}>적용</button>@endif</td>
        </tr>
        @empty
        <tr>
            <td colspan=100>미제출 리뷰어(블랙리스트)가 없습니다.</td>
        </tr>
        @endforelse
