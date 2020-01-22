    @forelse($reviews as $review)
    <li>
		<span class="bar">{{ $loop->iteration }}</span>
		<span class="bar">{{$review->reviewer->nickname}}</span>
		<span class="bar">@if($review->reviewer->gender=='m')남 @else여@endif</span>
		<span class="bar">{{$review->age}}</span>
		<span class="bar">{{$review->area}}</span>
        <span class="review"><a href="#">{{$review->after}}</a></span>
        <span class="td-btn"><a href="{{$review->url}}" target="_blank" class="btn small">리뷰보기</a></span>
        <span class="star">
            <em>만족도평가</em>
            <span class="star-input">
                <span class="input">
                    <input type="radio" name="star-input{{$review->id}}" value="1" id="p1{{$review->id}}">
                    <label for="p1{{$review->id}}">1</label>
                    <input type="radio" name="star-input{{$review->id}}" value="2" id="p2{{$review->id}}">
                    <label for="p2{{$review->id}}">2</label>
                    <input type="radio" name="star-input{{$review->id}}" value="3" id="p3{{$review->id}}">
                    <label for="p3{{$review->id}}">3</label>
                    <input type="radio" name="star-input{{$review->id}}" value="4" id="p4{{$review->id}}">
                    <label for="p4{{$review->id}}">4</label>
                    <input type="radio" name="star-input{{$review->id}}" value="5" id="p5{{$review->id}}">
                    <label for="p5{{$review->id}}">5</label>
                </span>				
            </span>
        </span>             
	</li>
    @empty
    <li>해당 리뷰어가 없습니다.</li>
    @endforelse
