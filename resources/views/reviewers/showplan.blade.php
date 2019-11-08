@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
                <div class="my-reviewer-top top2">
					<dl class="full_width">
						<dt><b>나의 리뷰전략 완성도</b><a href="reviewer_0302.php">리뷰전략 수정</a></dt>
						<dd>
							<div class="my_graph">
								<span class="g-bar" style="width:80%">
									<span class="num">80%</span>
								</span>
							</div>
						</dd>
					</dl>
				</div>

				<!-- 나의 리뷰전략 -->
				<div class="table_default influencer-view bt0">
					<div class="table_th">
						<span class="title">사진 전공자가 만드는 고퀄리티 리뷰</span>
					</div>

					<div class="table_td">
						<div class="table_td_line">
							<div class="view-img">
								<img src="/img/sub/ico_influencer.gif" alt="">
							</div> 

							<div class="view-info">
								<dl>
									<dt>이름/닉네임</dt>
									<dd>조지은 / 조조</dd>
								</dl>
								<dl>
									<dt>연락처</dt>
									<dd>010-0000-0000
										<span class="tell-ok">통화가능시간 00:00~00:00</span>
									</dd>
								</dl>
								<dl>								
									<dt>이메일</dt>
									<dd>0000@naver.com</dd>	
								</dl>
								<dl>							
									<dt>SNS</dt>
									<dd class="sns">
										<span class="ico-blog"><a href="#">blog.naver.com/0000</a></span>
										<span class="ico-insta"><a href="#">Instagram.com/0000</a></span>
									</dd>	
								</dl>
								<dl>							
									<dt>주소</dt>
									<dd>경남 양산시 어쩌고 저쩌고 12-34 경남 양산시 어쩌고 저쩌고 12-34 경남 양산시 어쩌고 저쩌고 12-34 경남 양산시 어쩌고 저쩌고 12-34</dd>
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
									<dd>부산, 경남</dd>
								</dl>
								<dl>
									<dt>카테고리</dt>
									<dd>맛집, 문화, 기타</dd>
								</dl>
								<dl>								
									<dt>리워드</dt>
									<dd>50000P</dd>	
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
								<p>리뷰어 경력 30년에 하루 방문자수 오천만을 자랑하는 이러쿵 저러쿵<br/>리뷰어 경력 30년에 하루 방문자수 오천만을 자랑하는 이러쿵 저러쿵<br/>리뷰어 경력 30년에 하루 방문자수 오천만을 자랑하는 이러쿵 저러쿵</p>
							</div>
						</div>				
					</div>

				</div>
				<!-- //나의 리뷰전략 -->
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
    
    // 캠페인 region 선택 area_s출력
    var nowRegion;// 현재지역명 기억
    $('input[name=region]').change(function(e){
       e.preventDefault();
        var now = $('input[name=region]:checked').val();
        nowRegion = $('input[name=region]:checked').next().html();
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
    
    //area_s선택시 선택된 지역 / 히든인풋 출력
    $('#select_area').on('change','input[name=area_s]',function(e){
       e.preventDefault();
        var now = $('input[name=area_s]:checked').val();
        var nowArea = $('input[name=area_s]:checked').next().html();
        var myP = '<p>'+nowRegion+' > '+nowArea+'<button type="button" class="p_close"><img src="/img/common/ico_close2.png" alt="닫기"></button><input type="hidden" name="area[]" value="'+now+'"></p>';
        $('#last_area').append(myP);
    });
    // 선택된 지역 삭제
    $('#last_area').on('click','.p_close',function(e){
        e.preventDefault();
        $(this).parent().remove();
    })
</script>


@include('reviewers.reviewer_bottommenu')
@endsection