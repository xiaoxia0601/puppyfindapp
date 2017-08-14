$(document).ready(function(){
	$(".nav a").on("click", function(){
		$(".nav").find(".active").removeClass("active");
		$(this).parent().addClass("active");
	});

	$(".user-icon").hover(
		function() {
			$(".user-link").fadeIn("slow");
		}, function() {
			$(".user-link").fadeOut("slow");
		}
	);


	var winH = $(window).height();
	var headH = $("#header").outerHeight(true);
	var footerH = $(".footer").outerHeight(true);
	var minH = winH - headH - footerH;
	console.log(winH + ", " + headH + ", " + footerH + ", " + minH);
	$("#maincontent").css("min-height", minH);
});

