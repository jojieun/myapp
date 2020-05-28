<div class="table_th">
						<p class="list_name">닉네임</p>
						<p class="list_info">정보요약</p>
						<p class="list_update">업데이트</p>
					</div>
                    @forelse($plans as $plan)
                    <div class="table_td">
						<a href="{{route('plans.show',$plan->id)}}">
							<div class="table_td_line">
								<p class="list_name">
                                    {{$plan->reviewer->nickname}}</p>
								<p class="list_info">
									<span class="title">{{$plan->title}}</span>
									<span class="txt">
                                        @foreach($plan->areas as $area)
                                        {{$area->region->name}} 
                                        {{$area->name}}
                                        @if(!$loop->last), @endif
                                        @endforeach
                                        |  
                                        @foreach($plan->categories as $category)
                                        {{$category->name}}
                                        @if(!$loop->last), @endif
                                        @endforeach</span>
									<span class="sns">
                                        @foreach($plan->channels as $channel)
                                        <span class="ch channel{{$channel->id}}">{{$channel->name}}</span>
                                        @endforeach
                                    </span>
								</p>
								<p class="list_update"><span class="pc-none-770">업데이트 : &nbsp;</span>
                                    {{ $plan->up }}</p>
							</div>
						</a>
					</div>
                    @empty
                    <div class="table_td">
                        인플루언서가 없습니다.
					</div>
                    @endforelse	