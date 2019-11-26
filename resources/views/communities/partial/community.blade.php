
						<div class="table_td_line">
							<p class="list_subj"><a  href="{{ route('communities.show', $community->id) }}"><span>{{$community->title}}</span></a></p>
							<p class="list_writer">
                                @if($community->reviewer)
                                {{$community->reviewer->nickname}}
                                @else
                                {{$community->advertiser->name}}
                                @endif
                            </p>
							<p class="list_date">{{$community->updated_at}}</p>
							<p class="list_count">{{$community->view_count}}</p>
						</div>
						