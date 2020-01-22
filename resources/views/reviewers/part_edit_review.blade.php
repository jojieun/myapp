    <form id="answer" type="post">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <div class="text3">
				<h3>리뷰 URL</h3>
				<p><input name="url" type="text" id="" value="{{ old('url', $review->url) }}" placeholder="리뷰 URL을 입력해주세요." class="full_width" /></p>
				<h3>캠페인 참여 후기</h3>
				<p><textarea name="after" id="" cols="1" rows="5" placeholder="광고주에게 전달할 캠페인 참여후기를 입력해주세요." class="border2">{{ old('after', $review->after) }}</textarea></p>
				<a data-id="{{ old('id', $review->id) }}" class="btn black h46" id="modal_submit">수정입력</a>
        </div>
        <a class="close" href="#select"></a>
</form> 
