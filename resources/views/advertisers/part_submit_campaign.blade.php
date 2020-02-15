    @forelse($reviews as $review)
    <li>
		<span class="bar">{{ $loop->iteration }}</span>
		<span class="bar">{{$review->reviewer->nickname}}</span>
		<span class="bar">@if($review->reviewer->gender=='m')남 @else여@endif</span>
		<span class="bar">{{$review->age}}</span>
		<span class="bar">{{$review->area}}</span>
        <span class="review"><a><div class="inner_review">{{$review->after}}</div></a></span>
        <span class="td-btn"><a href="{{$review->url}}" target="_blank" class="btn small">리뷰보기</a></span>
        <span class="star">
            <em>만족도평가</em>
            <span class="star-input">
                <span class="input">
                    @for($i=60;$i<101;$i+=10)
                    <input type="radio" class="mystar" name="star-input{{$review->id}}" value="{{$i}}" id="p{{$i}}{{$review->id}}" data-r="{{$review->id}}" @if($i==$review->satisfaction) checked @endif>
                    <label for="p{{$i}}{{$review->id}}">{{$i}}</label>
                    @endfor

                </span>				
            </span>
        </span>             
	</li>
    @empty
    <li style="text-align:center;">제출된 리뷰가 없습니다.</li>
    @endforelse
