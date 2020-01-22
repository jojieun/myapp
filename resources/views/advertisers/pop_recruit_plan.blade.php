				<div class="table_th">
					<span class="title">{{$plan->title}}</span>
				</div>
				<div class="table_td">
					<div class="table_td_line">
						<div class="view-img">
                            @if($plan->profile_image)
                            <img src="/files/profile/{{$plan->profile_image}}" alt="">
                            @else
							<img src="/img/sub/ico_influencer.gif" alt="">
                            @endif
						</div> 

						<div class="view-info">
							<dl>
								<dt>이름/닉네임</dt>
								<dd>{{$plan->reviewer->name}} / {{$plan->reviewer->nickname}}</dd>
							</dl>
							<dl>
								<dt>연락처</dt>
								<dd>
                                    @if(Auth::guard('advertiser')->check())
                                    {{$plan->reviewer->mobile_num}}
                                    @else
                                    광고주회원에게만 공개됩니다. 
                                    @endif
									<span class="tell-ok">통화가능시간 | {{$plan->call_time}}</span>
								</dd>
							</dl>
							<dl>								
								<dt>이메일</dt>
								<dd>
                                    @if(Auth::guard('advertiser')->check())
                                    {{$plan->reviewer->email}}
                                    @else
                                    광고주회원에게만 공개됩니다. 
                                    @endif
                                    </dd>	
							</dl>
							<dl>							
								<dt>SNS</dt>
								<dd class="sns">
                                    @if(Auth::guard('advertiser')->check())
                                     @foreach($plan->reviewer->channelreviewers as $chal)
                                    <span class="channel{{$chal->channel->id}}"><a href="{{$chal->channel->url}}{{$chal->name}}">{{$chal->channel->url}}{{$chal->name}}</a></span>
                                    @endforeach
                                    @else
                                    광고주회원에게만 공개됩니다. 
                                    @endif
								</dd>	
							</dl>
							<dl>							
								<dt>주소</dt>
								<dd>
                                    @if(Auth::guard('advertiser')->check())
                                    [{{$plan->reviewer->zipcode}}]
                                {{$plan->reviewer->address}}
                                {{$plan->reviewer->detail_address}}
                                    @else
                                    광고주회원에게만 공개됩니다. 
                                    @endif
                                </dd>
							</dl>
						</div>
					</div>				
				</div>
				<div class="table_td">
					<div class="table_td_line">
						<div class="view-title">
							<h3>희망 캠페인 조건</h3>
						</div> 

						<div class="view-info">
							<dl>
								<dt>지역</dt>
								<dd>@foreach($plan->areas as $area)
                                        {{$area->region->name}} 
                                        {{$area->name}}
                                        @if(!$loop->last), @endif
                                        @endforeach</dd>
							</dl>
							<dl>
								<dt>카테고리</dt>
								<dd>@foreach($plan->categories as $category)
                                        {{$category->name}}
                                        @if(!$loop->last), @endif
                                        @endforeach</dd>
							</dl>
							<dl>								
								<dt>리워드</dt>
								<dd>{{$plan->reward}}P</dd>	
							</dl>
						</div>
					</div>				
				</div>

				<div class="table_td">
					<div class="table_td_line">
						<div class="view-title">
							<h3>리뷰전략</h3>
						</div>
						<div class="view-info">
							{!!nl2br($plan->review_plan)!!}
						</div>
					</div>				
				</div>
<a class="close" href="#close"></a>