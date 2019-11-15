@extends('layouts.main')
@section('content')
<div class="sub-container bt-ddd">

		<!-- 상단 카테고리 필터 -->
		<section class="content-in-top">
			<div class="list_title">
				<h2>방문 캠페인</h2>
				<div class="map">
					<a href="#" class="btn-map" id="now_area">지역전체</a>
					<div class="map-on">
                        <span type="button" id="all_area" class="input-button2">지역전체</span>
                    @include('campaigns.map')
                        <div id="show_area">
                            <div id="region_name"></div>
                            <div id="area_close" class="close"></div>
                            <div id="area_area"></div>
                        </div>
                    </div>
				</div>
			</div>
			<div class="category">
				<dl>
					<dt>활동채널</dt>
					<dd>
						<span class="input-button2"><input name="channel" type="checkbox" id="channel00" value="0"><label for="channel00">전체</label></span>
                        @foreach($channels as $chl)
						<span class="input-button2"><input name="channel[]" type="checkbox" id="channel0{{$chl->id}}" value="{{$chl->id}}"><label for="channel0{{$chl->id}}">{{$chl->name}}</label></span>
                        @endforeach
					</dd>
				</dl>
				<dl>
					<dt>카테고리</dt>
					<dd>
						<span class="input-button"><input name="category" type="checkbox" id="category00"><label for="category00">전체</label></span>
                        @foreach($categories as $cate)
						<span class="input-button"><input name="category[]" type="checkbox" id="category0{{$cate->id}}" value="{{$cate->id}}"><label for="category0{{$cate->id}}">{{$cate->name}}</label></span>
                        @endforeach
					</dd>
				</dl>
			</div>
		</section>	
		<!-- //상단 카테고리 필터 -->

		<div class="m-bg-f4">		
			<section class="content-in2">
				<!-- 상단 리스트 필터 -->
				<div class="list-filter">
					<p id="nowcount">{{$campaigns->count()}}개의 캠페인</p>
					<ul>
						<li class="myorder on"><a href="#">최신순</a></li>
						<li class="myorder" data-o="campaigns.end_recruit"><a href="#">마감임박순</a></li>
						<li class="myorder" data-o="campaigns.view_count"><a href="#">인기순</a></li>
					</ul>
				</div>
				<!-- //상단 리스트 필터 -->

				<div class="campaign-list sub6">
					<ul>
				            @include('campaigns.part_campaign')
					</ul>
				</div>
                @if($campaigns->count())
                <div class="text-center paginator__article">
                  {!! $campaigns->render() !!}
                </div>
                @endif
			</section>
		</div>
	</div>
<script src="js/d3.min.js"></script>
  
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    var chl = []; //필터채널
    //채널 전체를 선택하면 다른 체널을 해제한다
   $('#channel00').change(function(){
        if($('#channel00').is(':checked')){
            $('input[name="channel[]"]').prop("checked", false);
            chl = '';
            getDatas();
        }
    });
    //채널 선택시
    $('input[name="channel[]"]').change(function(){
        chl = [];
        $('#channel00').prop("checked", false);
        $('input[name="channel[]"]:checked').each(function(){
            chl.push($(this).val());
        });
        getDatas();
    });
    var cate = []; //필터카테고리
    //카테고리 전체를 선택하면 다른 카테고리를 해제한다
   $('#category00').change(function(){
        if($('#category00').is(':checked')){
            $('input[name="category[]"]').prop("checked", false);
            cate = [];
            getDatas();
        }
    });
    //카테고리 선택시
    $('input[name="category[]"]').change(function(){
        cate = [];
        $('#category00').prop("checked", false);
        $('input[name="category[]"]:checked').each(function(){
            cate.push($(this).val());
        });
        getDatas();
    });
    //정렬방법
    var myorder = ''
    $('.myorder').click(function(){
       myorder = $(this).attr('data-o'); 
        getDatas();
        $('.myorder').removeClass('on');
        $(this).addClass('on');
    });
    
    //지역선택관련
    var now_area = '지역전체';
    
    $('#now_area').click(function(e){
        e.preventDefault();
        $('.map-on').toggle();
    })
    
    //지역별값넣기
    $('#sejong').attr('data-r',17);
    $('#chungnam').attr('data-r',5);
    $('#jeju').attr('data-r',13);
    $('#gyeongnam').attr('data-r',9);
    $('#gyeongbuk').attr('data-r',7);
    $('#jeonbuk').attr('data-r',15);
    $('#chungbuk').attr('data-r',14);
    $('#gangwon').attr('data-r',12);
    $('#gyeonggi').attr('data-r',2);
    $('#jeonnam').attr('data-r',11);
    $('#ulsan').attr('data-r',16);
    $('#busan').attr('data-r',8);
    $('#daegu').attr('data-r',6);
    $('#daejeon').attr('data-r',4);
    $('#incheon').attr('data-r',3);
    $('#seoul').attr('data-r',1);
    $('#gwangju').attr('data-r',10);

    $('.regions').attr('style','');
  function go_branch(city_do) {
      var Arr = Array("sejong","chungnam","jeju","gyeongnam","gyeongbuk","jeonbuk","chungbuk","gangwon","gyeonggi","jeonnam","ulsan","busan","daegu","daejeon","incheon","seoul","gwangju");
    var strArr = Array("세종특별자치시","충청남도","제주특별자치도","경상남도","경상북도","전라북도","충청북도","강원도","경기도","전라남도","울산광역시","부산광역시","대구광역시","대전광역시","인천광역시","서울특별시","광주광역시");
      var idx = Arr.indexOf(city_do);
      now_area = strArr[idx]+' ';
      $('#region_name').html(now_area);
  }
    $('#show_area').hide();
    //지역닫기
    $('#area_close').click(function(){
       $('#show_area').hide(); 
    });
    $('.regions').click(function(e){
       e.preventDefault();
        $('.regions').attr('style','');
      $(this).attr('style','fill: rgb(190, 190, 190);');
        var now = $(this).attr('data-r');
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
                your_html += "<span data-a='"+val.id+"' class='input-button2'>" +  val.name + "</span>"
            });
            $('#show_area').show(); 
            $('#area_area').html(your_html); 
        },
        error: function(data) {
        },
        processData: false,
        contentType: false
        });
    });
    //지역선택
    var myarea = '';
    $('#area_area').on('click', 'span', function(){
       myarea = $(this).attr('data-a');
        $('#now_area, #area_close').trigger('click');
        now_area += $(this).html();
        getDatas();
    });
    $('#all_area').on('click', function(){
        myarea = '';
        now_area = '지역전체';
        $('#now_area, #area_close').trigger('click');
        getDatas();
    });
    
    //필터 ajax
    function getDatas() {
    $.ajax({
        url : "{{ route('visit') }}",
        type : "post",
        dataType: 'json',
        data:{
            chl: chl,
            cate: cate,
            myorder: myorder,
            myarea: myarea
        },
        success:function(data){
          $('.campaign-list ul').html(data.finhtml);
            $('#nowcount').html(data.count+'개의 캠페인')
            $('#now_area').html(now_area)
        },
        error: function(request,status,error) {
            alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
        }
        });
    }
    
</script>
@endsection
