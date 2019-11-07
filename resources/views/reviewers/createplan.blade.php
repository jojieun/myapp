@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<div class="my-reviewer-top top2">
					<dl class="full_width">
						<dt><b>나의 리뷰전략</b></dt>
						<dd>
							<div class="my_graph">
								<span class="g-bar" style="width:0%">
									<span class="num black">0%</span>
								</span>
							</div>
						</dd>
					</dl>
				</div>

				<!-- 리뷰전략 등록-->
				<form method="post" action="{{ route('plans.store') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
					<div class="table_form2 bt0">
						<dl>
							<dt>리뷰전략 제목</dt>
							<dd><input name="title" type="text" id="" value="{{ old('title') }}" placeholder="리뷰전략 제목을 입력해주세요." class="full_width mb10" /></dd>
                            {!! $errors->first('title','<span class="red">:message</span>')!!}
						</dl>
						<dl>
							<dt class="lh120">프로필이미지</dt>
							<dd>
								<div class="file-area">
									<span class="upload">
										<label for="file">									
											<input name="profile_image" type="file" id="file" value="" placeholder="상세이미지" class="full_width mb10" />
										</label>
									</span>
								</div>
							</dd>
                            {!! $errors->first('profile_image','<span class="red">:message</span>')!!}
						</dl>
						<dl class="bar">
							<dt>방문가능 시간</dt>
							<dd><input name="call_time" type="text" id="" value="" placeholder="예) 평일 10:00~17:00" class="full_width mb10" /></dd>
                            {!! $errors->first('call_time','<span class="red">:message</span>')!!}
						</dl>

						<h3 class="title">희망 캠페인 조건</h3>
						<dl>
							<dt>지역</dt>
							<dd class="mb10">
								<div class="wrap_scroll">
									<div class="scroll-style br0">
										<ul class="filter-area">
                                            @forelse($regions as $region)
                                            <li><span class="input-button4"><input name="region" type="radio" id="area{{$region->id}}" value="{{$region->id}}"><label for="area{{$region->id}}">{{$region->name}}</label></span></li>
                                            @empty
										      <li value="">지역이 없습니다</li>
                                            @endforelse
										</ul>
									</div>
									<div class="scroll-style">
										<ul class="filter-area2" id="select_area">
											<li>시,도 를 선택해주세요</li>
										</ul>
									</div>
								</div>
								<div class="view-area" id="last_area">
									<p>서울 > 서초구<button type="button"><img src="/img/common/ico_close2.png" alt="닫기"></button></p>
                                    <p>서울 > 서초구<img src="/img/common/ico_close2.png" alt="닫기"></p>
								</div>
							</dd>
                            {!! $errors->first('','<span class="red">:message</span>')!!}
						</dl>
						<dl>
							<dt>카테고리</dt>
							<dd>
                                @foreach($categories as $category)
                                <span class="input-button"><input name="category" value="{{$category->id}}" type="checkbox" id="category{{$category->id}}"><label for="category{{$category->id}}">{{$category->name}}</label></span>
                                @endforeach
							</dd>
                            {!! $errors->first('category','<span class="red">:message</span>')!!}
						</dl>
                        <dl class="bar">
							<dt>리워드</dt>
							<dd><input name="reward" type="number" id="reward" value="" placeholder="리뷰 작성시 광고주로부터 받기 원하는 금액(포인트)을 적어주세요 예) 10000 *숫자만 적어주세요*" class="full_width mb10" mim="0" step="1000"/></dd>
                            {!! $errors->first('reward','<span class="red">:message</span>')!!}
						</dl>
						<dl>
							<dt>리뷰전략</dt>
							<dd><textarea name="review_plan" id="" cols="1" rows="5" placeholder=" " class="border2"></textarea></dd>
                            {!! $errors->first('review_plan','<span class="red">:message</span>')!!}
						</dl>
					</div>

					<div class="join_btn_wrap">
						<button type="submit" class="btn black">리뷰전략 등록</button>
					</div>
				</form>
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    //    이미지업로드바로보기
    $('input[name=profile_image]').change(function(e){
       e.preventDefault();
        $('label[for=file]').css({
                   backgroundImage:"url('"+ URL.createObjectURL(event.target.files[0])+"')"
               });
         });
        //-----이미지업로드바로보기
    
    // 캠페인 region 선택 area출력
    $('input[name=region]').change(function(e){
       e.preventDefault();
        var now = $('input[name=region]:checked').val();
        var $data = new FormData();
        $data.append('region', now);
        $.ajax({
        type: 'POST',
        url: "{{ route('campaigns.makearea') }}",
        data: $data,
        success: function(data) {
            var obj = data.areas;
            var your_html = "";
            $.each(obj, function (key, val) {
                your_html += '<li><span class="input-button4"><input name="area_s" type="radio" id="area2-'+val.id+'" value="'+val.id+'"><label for="area2-'+val.id+'">'+  val.name +'</label></span></li>'
            });
         $("#select_area").html(your_html) 
        },
        error: function(data) {
        },
        processData: false,
        contentType: false
            });
    });
    // ------캠페인 region 선택 area출력
    $('#select_area').on('change','input[name=area_s]',function(e){
       e.preventDefault();
        var now = $('input[name=area_s]:checked').val();
        var myHtml = $('<input>').attr({
            value:now,
            type:'hidden',
            name:'area[]'
        })
        $('#last_area').append(myHtml);
    });
    
</script>


@include('reviewers.reviewer_bottommenu')
@endsection