<li>
								<div class="reviewer-list-thum">
									<img src="/files/{{$campaign->main_image}}" alt="">
								</div>
								<div class="reviewer-list-info">
									<div class="list-info-top">
										<p class="tag-area">
											@if($campaign->form == 'v')
    				<span class="v">방문</span>
                                @else
                                <span class="h">재택</span>
                                @endif
											<span class="bg-bl">
                                    @if($campaign->region_name)
                                    {{$campaign->region_name.' '.$campaign->area_name}}
                                    @else
                                    {{$campaign->category_name}}
                                    @endif
                                </span>
											<span class="sns"><span class="channel{{$campaign->channel_id}}">{{$campaign->channel_name}}</span></span>
											<span class="num"><b>신청 {{$campaign->applyCount}}</b> / {{$campaign->recruit_number}}명</span>
											<span class="dday @if($campaign->rightNow=='Day') on @endif">D-{{$campaign->rightNow}}</span>
										</p>									
										<p class="subject">{{$campaign->name}}</p>
    			<p class="subtxt">{{$campaign->offer_goods}} + {{number_format($campaign->offer_point)}} 포인트 지급 </p>
									</div>
									<div class="campaign-list-info-right">
<!--
										<a href="#" class="btn btn-check w125 black">리뷰제출</a>
                                        <a href="#" class="btn btn-check w125">리뷰보기</a>
-->
									</div>
								</div>
							</li>