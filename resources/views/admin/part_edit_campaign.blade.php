<form method="post" id="modify_form" enctype="multipart/form-data" class="form__auth">
        {!! csrf_field() !!}        
<table>
            <tbody>
            

        <tr>
            <th width="100">광고주</th>
            <td>{{$campaign->advertiser->name}}
            <input type="hidden" name="campaign_id" value="{{$campaign->id}}">
            </td>
        </tr>
        <tr>
            <th>광고주 연락처</th>
            <td>{{$campaign->advertiser->mobile_num}}</td>
        </tr>
        <tr>
            <th>작성일</th>
            <td>{{$campaign->created_at}}</td>
        </tr>
        <tr>
            <th>결제금액</th>
            <td>{{number_format($campaign->payment)}}원</td>
        </tr>
        <tr>
            <th>진행형태</th>
            <td>@if($campaign->form=='v')재택@else방문@endif
                <input type="hidden" name="form" value="{{$campaign->form}}">
            </td>
        </tr>
        <tr>
            <th>브랜드명</th>
            <td>{{$campaign->brand->name}}</td>
        </tr>
        <tr>
            <th>카테고리</th>
            <td>{{$campaign->brand->category->name}}</td>
        </tr>
        <tr>
            <th>캠페인명</th>
            <td>
            <input type="text" name="name" value="{{ old('name', $campaign->name) }}">
            </td>
        </tr>
        <tr>
            <th>모집인원</th>
            <td><input type="number" value="{{ old('recruit_number', $campaign->recruit_number)}}" name="recruit_number"></td>
        </tr>
        <tr>
            <th>제공포인트</th>
            <td><input name="offer_point" type="number" value="{{ old('offer_point', $campaign->offer_point)}}"></td>
        </tr>
        <tr>
            <th>제공물품</th>
            <td><input name="offer_goods" type="text" value="{{ old('offer_goods', $campaign->offer_goods)}}"></td>
        </tr>
        <tr>
            <th>모집채널</th>
            <td>
                @forelse($channels as $channel)		
                                <span class="input-button2"><input name="channel_id" type="radio" id="channel0{{$channel->id}}" value="{{$channel->id}}" @if( $channel->id == old('channel_id',$campaign->channel_id) ) checked @endif><label for="channel0{{$channel->id}}">{{$channel->name}}</label></span>
                                @empty
                                모집채널이 없습니다.
                                @endforelse</td>
        </tr>
        <tr>
            <th>모집시작일</th>
            <td>
                <input value="{{ old('start_recruit',$campaign->start_recruit)?: date('Y-m-d') }}" name="start_recruit" type="date" size="20" title="시작일" class="m_mb10 input-date" data-date='{"startView": 2, "openOnMouseFocus": true}' placeholder="년도-월-일" />
            </td>
        </tr>
        <tr>
            <th>모집마감일</th>
            <td>
                <input value="{{ old('end_recruit',$campaign->end_recruit)?: date('Y-m-d') }}" name="end_recruit" type="date" size="20" title="모집마감일" class="m_mb10 input-date" data-date='{"startView": 2, "openOnMouseFocus": true}' placeholder="년도-월-일" />
            </td>
        </tr>
        <tr>
            <th>제출마감일</th>
            <td>
                <input value="{{ old('end_submit',$campaign->end_submit)?: date('Y-m-d') }}" name="end_submit" type="date" size="20" title="제출마감일" class="m_mb10 input-date" data-date='{"startView": 2, "openOnMouseFocus": true}' placeholder="년도-월-일" />
            </td>
        </tr>
        <tr>
            <th>대표이미지</th>
            <td>
                <img src="/files/{{$campaign->main_image }}" width="400">
                <br/>
                <input name="main_image" type="file" id="file" value="" placeholder="대표이미지" class="full_width mb10" accept=".jpg,.jpeg,.png,.gif,.bmp"/>	
            </td>
        </tr>
        <tr>
            <th>상세이미지</th>
            <td>
                상세이미지1 :<br/>
                @if($campaign->sub_image1 )
                <img src="/files/{{$campaign->sub_image1 }}" width="400"><br/>
                @endif
                <input name="sub_image1" type="file" id="file" value="" placeholder="상세이미지1" class="full_width mb10" accept=".jpg,.jpeg,.png,.gif,.bmp"/><br/>
                상세이미지2 :<br/>
                @if($campaign->sub_image2 )
                <img src="/files/{{$campaign->sub_image2 }}" width="400"><br/>
                @endif
                <input name="sub_image2" type="file" id="file" value="" placeholder="상세이미지2" class="full_width mb10" accept=".jpg,.jpeg,.png,.gif,.bmp"/><br/>
                상세이미지3 :<br/>
                @if($campaign->sub_image3 )
                <img src="/files/{{$campaign->sub_image3 }}" width="400"><br/>
                @endif
                <input name="sub_image3" type="file" id="file" value="" placeholder="상세이미지3" class="full_width mb10" accept=".jpg,.jpeg,.png,.gif,.bmp"/><br/>
            </td>
        </tr>
        <tr>
            <th>담당자연락처</th>
            <td>
                <input name="contact" type="text" id="" value="{{ old('contact',$campaign->contact) }}" class="full_width" />
            </td>
        </tr>
        <tr>
            <th>리뷰미션</th>
            <td>
                <textarea name="mission" id="" cols="1" rows="5" class="border2">{{ old('mission',$campaign->mission) }}</textarea>
            </td>
        </tr>
        <tr>
            <th>리뷰키워드</th>
            <td>
                <input name="keyword" type="text" id="" value="{{ old('keyword',$campaign->keyword) }}" class="full_width" />
            </td>
        </tr>
        <tr>
            <th>기타사항</th>
            <td>
                <textarea name="etc" id="" cols="1" rows="5" class="border2">{{ old('etc',$campaign->etc) }}</textarea>
            </td>
        </tr>
        @if($campaign->form=='v')
        <tr>
            <th>지역</th>
            <td>
            <select id="regions" class="select_po" name="region_id">
                <option value="선택">선택</option>
                @forelse($regions as $region)
                <option value="{{ $region->id }}" @if($campaign->area_id && $region->id == $campaign->area->region_id ) selected @endif>{{ $region->name }}</option>
                @empty
                <option value="">지역이 없습니다</option>
                @endforelse
                </select>
                <select id='areas' class="select_po @if(!old('area_id', $campaign->area_id)) hide @endif" name='area_id' value="">
                    <option value="">지역이 없습니다</option>
                    @if(old('area_id', $campaign->area_id))
                    <option value="{{$campaign->area_id}}" selected>{{$campaign->area->name}}</option>
                    @endif
                </select>
            </td>
        </tr>
        <tr>
            <th>방문가능시간</th>
            <td>
                <input name="visit_time" type="text" id="" value="{{ old('visit_time',$campaign->visit_time) }}" class="full_width" />
            </td>
        </tr>
        <tr>
            <th>주소</th>
            <td>
                <input type="hidden" name="zipcode" placeholder="우편번호" value="{{old('zipcode',$campaign->zipcode)}}" id="sample6_postcode"/>
                <input name="address" type="text" placeholder="주소" class="w150 mb10" value="{{ old('address',$campaign->address) }}" id="sample6_address"/><button type="button" name="button" class="btn btn-check" onclick="sample6_execDaumPostcode()">주소검색</button>
                <input name="detail_address" type="text" placeholder="상세주소" class="full_width" value="{{ old('detail_address',$campaign->detail_address) }}" id="sample6_detailAddress"/>
            </td>
        </tr>
        @endif
        
        
        <tr>
            <td colspan="2" class="last">
            <button class="modify_save" type="button">수정하기</button>
            </td>
        </tr>
                </tbody>
    </table>
</form>
<a href="#close" class="close"></a>
