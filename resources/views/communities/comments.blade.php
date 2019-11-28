@forelse($comments as $comment)
<li>
						<span class="comment-id">
							<p>
                            @if($comment->reviewer)
                                {{$comment->reviewer->nickname}}
                                @else
                                {{$comment->advertiser->name}}
                                @endif
                            </p>
							<span>{{$comment->created_at}}</span>
						</span>
						<span class="comment-txt">
    {!! nl2br($comment->content) !!}
    </span>
					</li>
@empty
					<li>
						댓글이 없습니다.
					</li>
@endforelse