//$(document).ready(function() {
	
	
//	setSize();
//	$(window).resize(function () {
//	    setSize();
//	});
//});
$(window).resize(function () {
   	    setSize();
  	});
function setSize()
{
    var pad = $(".content-box .row").height();
    var banboxB = $(".banner-box").height();
    var headerH = $("header").innerHeight();
    /*alert(headerH);*/
    var bannerH = $(".f-banner").height();
    /*alert(bannerH);*/
    var footerH = $(".footer").height();
    var minH = $(window).height() - headerH - bannerH - footerH;
    /*alert(minH);*/
    $(".f-tab").css('minHeight', minH);
    var minhh = $(window).height() - headerH - banboxB - footerH - pad;
    $(".banner-box").css('margin-bottom', minhh / 2);
    if ( $(window).height() < 765 && $(window).width() > 1170 ) {
        $(".banner-box").css('margin-bottom', 20);
        $(".footer").css({ "position": "static" });
    }
    else if ($(window).height() < 740 && $(window).width() < 1170 && $(window).width() > 765) {
        $(".banner-box").css('margin-bottom', 20);
        $(".footer").css({ "position": "static" });
    }

    else if ($(window).height() > $("body").height() && $(window).width() > 765) {
        //$(".banner-box").css('margin-bottom', minhh / 2);
        $(".footer").css({ "position": "fixed", "left": 0, "bottom": 0 });
    }
    

    else if ($(window).height() < $("body").height() && $(window).width() < 765 && $(window).width() > 600) {
        $(".banner-box").css('margin-bottom', 20);
        $(".footer").css({ "position": "static" });
    }
    else if ($(window).height() > $("body").height() && $(window).width() < 765) {
        $(".banner-box").css('margin-bottom', minhh / 2);
        $(".footer").css({ "position": "fixed", "left": 0, "bottom": 0 });
    }
    else {

        $(".footer").css({ "position": "static" });
    }

}