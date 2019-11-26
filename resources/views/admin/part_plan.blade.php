    <table>
     <tr>
            <th>제목</th>
        <td>{{ $plan->title }}</td>
        </tr>
        <tr>
            <th>프로필이미지</th>
        <td><img src="/files/profile/{{$plan->profile_image}}"></td>
        </tr> 
        <tr>
            <th>통화가능시간</th>
        <td>{{$plan->call_time}}</td>
        </tr> 
        <tr>
            <th>리워드</th>
        <td>{{$plan->reward}}</td>
        </tr>
        <tr>
            <th>리뷰전략</th>
        <td>{!! nl2br($plan->review_plan) !!}</td>
        </tr>
    </table>
<a href="#close" class="close"></a>
