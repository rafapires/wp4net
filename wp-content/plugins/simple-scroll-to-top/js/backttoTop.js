// JavaScript Document
$STop = jQuery.noConflict();
$STop ( function() {
	$STop("body").append('<div id="GotoTop" class="GotoTop">&#9650;</div>');
	$STop(window).scroll(function() {
		if($STop(this).scrollTop()!=0) {
			$STop("#GotoTop").fadeIn()
		}else{
			$STop("#GotoTop").fadeOut()
		}
	}
);
$STop("#GotoTop").click( function(){$STop("body,html").animate({scrollTop:0},800)})});