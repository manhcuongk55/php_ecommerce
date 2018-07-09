$(document).ready(function(){
	$('#txt_keyword').focus(function(){
		$(this).val('');
	});
	$('#txt_keyword').blur(function(){
		if($(this).val()==''){ $(this).val('Từ khóa');}
	});
	$(this).find(".submenu").hide();
	$("#nav ul li").hover(function(){
		var popup= $(this).find(".submenu");
			if(popup){popup.show('slow');}
		},function(){ 
			var popup= $(this).find(".submenu");
			if(popup) popup.hide('slow'); 
	});
	$('#body div.item img').hover(
		function(){
			var url=$(this).attr('src');
			new_url=url.replace('thumb/','');
			$(this).attr('src',new_url);
		},
		function(){
			//alert(url);
		}
	);
	$('#popup span.close').click(function(){$('#bg_popup').hide(); $('#popup').hide();});
	$('#bg_popup').click(function(){$('#popup').hide(); $(this).hide();});
	$('#login').click(function(){
		$('#popup #title').html('Đăng nhập thành viên');
		$.post('http://muathu7.vn/ajaxs/member_login.php',function(data){
			$('#popup #content').html(data);
			$('#popup').css('left',($(window).width()-$('#popup').outerWidth())/ 2 + 'px');
			$('#popup').css('top',($(window).height()-$('#popup').outerHeight())/ 2 + 'px');
			$('#popup').show();
			$('#bg_popup').show();
		});
	});
	$("#back-top").hide();
	
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
			if ($(this).scrollTop() >=300) {
				$('#adl').css({'position':'fixed','top':'5px','left':'-35px'});
				$('#adr').css({'position':'fixed','top':'5px','right':'-35px'});
				
			} else {
				$('#adl').css({'position':'absolute','top':'5px','left':'-218px'});
				$('#adr').css({'position':'absolute','top':'5px','right':'-218px'});
			}
		});
		$('#back-top a').click(function () {
			$('body,html').animate({scrollTop: 0}, 'slow');
			return false;
		});
		$('#link_detail').click(function () {
			var top=$('.detail_product').offset().top;
			$('html, body').animate({scrollTop:top}, 'slow');
			return false;
		});
		$('#link_comment').click(function () {
			var top=$('#prodct_comment').offset().top;
			$('html, body').animate({scrollTop:top}, 'slow');
			return false;
		});
	});

	$('.box-hotline').hide();
    $('.support_online .title').click(function () {
		$('.box-hotline').toggle('slow');
	}); 
	$('#search #frm_search span.close').click(function () {
		if ( $("#search #frm_search span.close").css("background") === "url(http://muathu7.vn/templates/igf/css/../images/next.png)")
		{
			$('#text_search').css('width' ,'56px' );
			$(this).css('background','url("../images/preview.png") no-repeat scroll right -3px transparent');
		}
		else{
			$('#text_search').css('width' ,'256px' );
			$(this).css('background','url("http://muathu7.vn/templates/igf/css/../images/next.png") no-repeat right -3px');
		}
	});
});