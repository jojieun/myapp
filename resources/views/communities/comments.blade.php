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
    @if((Auth::guard('advertiser')->check() && (auth()->guard('advertiser')->user()->id==$comment->advertiser->id)) || (Auth::guard('web')->check() && (auth()->guard('web')->user()->id==$comment->reviewer->id)) || Auth::guard('admin')->check() )
    <a class="comment_del" data-id="{{$comment->id}}">삭제</a>
    @endif
					</li>
@empty
					<li>
						댓글이 없습니다.
					</li>
@endforelse