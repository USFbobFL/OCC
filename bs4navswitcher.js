/*
bs4navswitcher.js 
written 7/26/2019 by Bob Bedford
*/
page_ref = "";
nav_id = "";
page_fade_duration_ms = 500;  // 1000 = 1 seconed
$(".page-nav").click(function(){
	nav_id = $(this).attr("id");
	page_ref = $(this).attr("data-page-id");
	$(".page_div").addClass("d-none");
	$(".page_div").css("opacity", 0);
	$("#"+page_ref).removeClass("d-none");
	$("#"+page_ref).animate({
       opacity: 1
    }, page_fade_duration_ms, function() {
	   $("#"+nav_id).addClass("hi-nav text-warning");	
    });
  	$(".page-nav").removeClass("hi-nav text-warning");
});