        @forelse ($agencies as $agency)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $agency->title }}</td>
            <td>{{$agency->advertiser->name}}
            | 연락처: {{$agency->advertiser->mobile_num}}
            </td>
            <td>{{ $agency->created_at }}</td>
            <td>
                @if(isset($agency->process))
                <button class="answer" value="{{ $agency->id }}">수정하기</button>
                @else
                <button class="answer" value="{{ $agency->id }}">처리하기</button>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan=100>캠페인 대행 의뢰가 없습니다.</td>
        </tr>
        @endforelse
