<table>
            <tr>
                <th>이메일</th>
                <th>이름</th>
                <th>리뷰제출</th>
            </tr>
    @forelse($campaign_reviewers as $campaign_reviewer)
        <tr>
            <td>{{$campaign_reviewer->reviewer->email}}</td>
            <td>{{$campaign_reviewer->reviewer->name}}</td>
            <td>@isset($campaign_reviewer->new_review->url){{$campaign_reviewer->new_review->url}}@endisset</td>
        </tr>
    @empty
        <tr>
        <td colspan="10">신청리뷰어가 없습니다.</td>
        </tr>
    @endforelse
    </table>

<a href="#close" class="close"></a>
