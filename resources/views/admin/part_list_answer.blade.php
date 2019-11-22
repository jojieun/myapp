        @forelse ($onetoones as $onetoone)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $onetoone->qcategory->name }}</td>
            <td>{{ $onetoone->title }}</td>
            <td>@if($onetoone->reviewer)
                                {{$onetoone->reviewer->nickname}}(리뷰어)
                                @else
                                {{$onetoone->advertiser->name}}(광고주)
                                @endif</td>
            <td>{{ $onetoone->created_at }}</td>
            <td><button class="answer" value="{{ $onetoone->id }}">답변하기</button></td>
        </tr>
        @empty
        <tr>
            <td colspan=100>미답변 1:1문의가 없습니다.</td>
        </tr>
        @endforelse
