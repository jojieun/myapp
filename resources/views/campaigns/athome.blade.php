@extends('layouts.main')
@section('content')
<div class="sub-container bt-ddd">

		<!-- 상단 카테고리 필터 -->
		<section class="content-in-top">
			<div class="list_title">
				<h2 class="bg-none">재택 캠페인</h2>
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
                        
                        <span class="input-button"><input name="category[]" type="checkbox" id="category02" value="2"><label for="category02">생활</label></span>
                        <span class="input-button"><input name="category[]" type="checkbox" id="category06" value="6"><label for="category06">유아동</label></span>
                        <span class="input-button"><input name="category[]" type="checkbox" id="category05" value="5"><label for="category05">디지털</label></span>
                        <span class="input-button"><input name="category[]" type="checkbox" id="category03" value="3"><label for="category03">뷰티</label></span>
                        <span class="input-button"><input name="category[]" type="checkbox" id="category08" value="8"><label for="category08">패션</label></span>
                        <span class="input-button"><input name="category[]" type="checkbox" id="category010" value="10"><label for="category010">도서</label></span>
                        <span class="input-button"><input name="category[]" type="checkbox" id="category07" value="7"><label for="category07">식품</label></span>
                        <span class="input-button"><input name="category[]" type="checkbox" id="category012" value="12"><label for="category012">앱 웹</label></span>
					</dd>
				</dl>
			</div>
		</section>	
		<!-- //상단 카테고리 필터 -->

		<div class="m-bg-f4">		
			<section class="content-in2">
				<!-- 상단 리스트 필터 -->
				<div class="list-filter">
					<p>{{$campaigns->count()}}개의 캠페인</p>
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
    
    //필터 ajax
    function getDatas() {
    $.ajax({
        url : "{{ route('athome') }}",
        type : "post",
        dataType: 'json',
        data:{
            chl: chl,
            cate: cate,
            myorder: myorder,
        },
        success:function(data){
          $('.campaign-list ul').html(data.finhtml);
            $('#nowcount').html(data.count+'개의 캠페인')
        },
        error: function(request,status,error) {
            alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
        }
        });
    }
    
</script>
@endsection