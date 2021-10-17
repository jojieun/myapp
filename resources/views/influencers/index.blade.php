@extends('layouts.main')
@section('content')
<div class="sub-container bt-ddd">

		<!-- 상단 카테고리 필터 -->
		<section class="content-in-top">
			<div class="list_title">
				<h2>인플루언서</h2>
				<div class="map">
					<a href="#" class="btn-map" id="now_area">지역전체</a>
					<div class="map-on">
                        <div class="region_wrap">
                        <span id="all_area">지역전체</span>
                        </div>
                        <? $region_num = 1; ?>
                        @forelse($areas as $area)
                        
                        @if($loop->first)
                        <div class="region_wrap">
                            <div class="region_name area" data-a="{{$area->id}}">{{ $area->region->name }}</div>
                            <div class="area_wrap">
                        @endif
                        @if($region_num!=$area->region_id)
                        <? $region_num=$area->region_id; ?>
                        </div></div>
                        <div class="region_wrap">
                            <div class="region_name" >{{ $area->region->name }}</div>
                            <div class="area_wrap">
                        @endif
                                <span class="area" data-a="{{$area->id}}">{{$area->name}}</span>
                        @if($loop->last)
                            </div></div>
                        @endif
                        @empty
                        지역이 없습니다.
                        @endforelse
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

		<section class="content-in-sub mt30">

			<!-- 검색 -->
			<div class="board_navi_box list">				
				<span class="search mr0">
					<input name="" type="text" placeholder="검색어를 입력해주세요"><a href="#"><img src="/img/common/ico_search.gif" alt="검색"></a>
				</span>
			</div>
			<!-- //검색 -->
			<!-- 여기부터 게시판 목록 테이블폼입니다. -->
			<form>
				<div  class="table_default pd28">
					@include('influencers.part_list')
				</div>	
			</form>

			<!-- 페이지 위치 -->
            @if($plans->count())
                <div class="text-center paginator__article">
                  {!! $plans->render() !!}
                </div>
                @endif
			<!-- //페이지 위치 -->
			<!-- 여기까지 게시판 테이블폼입니다. -->
			</section>
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
    
    //지역선택관련
    var now_area = '지역전체';
    
    $('#now_area').click(function(e){
        e.preventDefault();
        $('.map-on').toggle();
    })
    
    var myarea = '';
    $('.area').on('click', function(){
       myarea = $(this).attr('data-a');
        $('#now_area').trigger('click');
        now_area = $(this).parent().parent().find('.region_name').html()+ ' ';
        now_area += $(this).html();
        getDatas();
    });
    $('#all_area').on('click', function(){
        myarea = '';
        now_area = '지역전체';
        $('#now_area').trigger('click');
        getDatas();
    });
    
    //필터 ajax
    function getDatas() {
    $.ajax({
        headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
        url : "{{ route('influencers.index') }}",
        type : "post",
        dataType: 'json',
        data:{
            chl: chl,
            cate: cate,
            myarea: myarea
        },
        success:function(data){
//            alert(data.what);
          $('.table_default').html(data.finhtml);
            $('#now_area').html(now_area)
        },
        error: function(request,status,error) {
            alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
        }
        });
    }
    
</script>
@endsection
