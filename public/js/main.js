//상단 전체 메뉴
$(function(){
	$( ".mainMenu" ).hover(
  		function() {
		if($(window).width() > 990){
				$(".depth").show();
		}
  		}, function() {
		if($(window).width() > 990){	
				$(".depth").hide();
		}	
  		}
	);
})

$(function(){
	$( ".my" ).hover(
  		function() {
		if($(window).width() > 990){
				$(".my_list").show();
		}
  		}, function() {
		if($(window).width() > 990){	
				$(".my_list").hide();
		}	
  		}
	);
})

//메뉴버튼 처리
$(function(){
	$("#btn_menulist_view").click(function(){
		$("#main_menus").show();
		$(".depth").show();	
		$("#back_z").addClass("body-slider-ovclick");
		$("#main_menus").addClass("sc_control");
	});
	$("#close_menu").click(function(){
		$("#main_menus").removeClass("sc_control");
		$(".menulists_xtype").hide();
		$("#back_z").removeClass("body-slider-ovclick");
		$('#main_menus').off('scroll touchmove mousewheel');
		$("body").removeClass("not_scroll");
	});
	$(".mainmenu").click(function(){
		
	});
})

//TOP 메뉴
$(function(){
	window.onresize = resize;
	function resize()
	{
		if($(window).width() > 1000){
				$(".menulists_xtype").css("display", "");
		}else{
		
		}
	}
});

// 서브메뉴
function submenu_chk(id_view, url){
	if($(window).width() < 1000){
		var on_class = 	$("#"+id_view).attr('class');
		
		if(on_class.indexOf("on")==-1){
			$("#"+id_view).show();
			$("#"+id_view).addClass("on");
		}else{
			$("#"+id_view).hide();
			$("#"+id_view).removeClass("on");
		}
	}else{
	location.href=url;
	}
}

//캠페인 보기
$(document).ready(function () {
	$(window).scroll(function () {
		if($(this).scrollTop() > 740) {                 
			$('#navbar').addClass("sticky");                     
		}else {
		   
			$('#navbar').removeClass("sticky");
		}
	});
});