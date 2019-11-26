@forelse($faqs as $faq)					
<div class="item">
						<div class="heading">
							<p class="list_subj">{{$faq->question}}</p>
						</div>
						<div class="content">
						{!! nl2br($faq->answer) !!}
						</div>
					</div>
					@empty
<div class="item">
해당 카테고리 자주묻는 질문이 없습니다.
					</div>
@endforelse
<script>
$('.item .heading').click(function() {
		
	var a = $(this).closest('.item');
	var b = $(a).hasClass('open');
	var c = $(a).closest('.faq').find('.open');
		
	if(b != true) {
		$(c).find('.content').slideUp(200);
		$(c).removeClass('open');
	}

	$(a).toggleClass('open');
	$(a).find('.content').slideToggle(200);

});
</script>