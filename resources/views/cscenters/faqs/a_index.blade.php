@extends('layouts.main')

@section('content')
	<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
		<!-- //탭-->
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
			<!-- 왼쪽메뉴 -->
			@include('cscenters.leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2>FAQ 광고주</h2>
				
				<!-- 탭-->				
<!--
				<ul class="detail_tab2">
					<li><a href="faq.php" class="on">리뷰어</a></li>
					<li><a href="#">광고주</a></li>
				</ul>
-->
				<!-- //탭-->
				
				<ul class="board-tab">
                    @forelse($afcategories as $afcategory)
                    <li data-id="{{$afcategory->id}}"><a>{{$afcategory->name}}</a></li>
                    @empty
                    <li>카테고리가 없습니다</li>
                    @endforelse
				</ul>

				<!-- 여기부터 FAQ 목록입니다. -->
				<div class="faq">
					@include('cscenters.faqs.part')
				</div>

			</div>				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
<script>
$('.board-tab li').first().addClass('on');
$.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    $('.board-tab li').click(function(){
        $('.board-tab li').removeClass('on');
        $(this).addClass('on');
        var nowc = $(this).data('id');
        $.ajax({
            headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
        url : "/advertiser_faqs_list/"+nowc,
        type : "post",
//        dataType: 'json',
        data:{
            nowc: nowc,
        },
        success:function(data){
          $('.faq').html(data.finhtml);
        },
        error: function(request,status,error) {
            alert("code = "+ request.status + " message = " + request.responseText + " error = " + error);
        }
        });
    });
</script>
@endsection