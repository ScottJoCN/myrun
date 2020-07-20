
//乐才概览-经典行业客户 customitem
$('#lccustomerList .customitem').hover(function () {
    $(this).find('.coverlogo').addClass('leftshow');
    $(this).find('.customtitle').hide();
}, function () {
    $(this).find('.coverlogo').removeClass('leftshow');
    $(this).find('.customtitle').show();
});

// 乐才概览 video
$('.video').click(function () {
    var flag = $(this).data('src');
    var video = document.getElementById('video' + flag);
    $('.video-mask').show();
    $('.video-wrap-' + flag).show();
    video.play();
});
$('.video-mask').click(function () {
    $('.video-mask').hide();
    var id = $('.video-wrap:visible').find('video').attr('id');
    var video = document.getElementById(id);
    video.pause();
    video.currentTime = 0;
    $('.video-wrap:visible').hide();
})



headerfixed(); 
headerAboutFixed(); // 关于我们头部二级导航定位
animateSlideIn('.animate-slide-item');
$(window).scroll(function () {
    headerfixed(); // 头部二级导航定位
    headerAboutFixed();// 关于我们头部二级导航定位
    animateSlideIn('.animate-slide-item'); // 乐才-场景页：页面内容渐入式出现
    navClass("#anchor li", ".anchorsession");//直播-滚动到锚点处导航样式跟着变化
});

// 头部二级导航定位
function headerfixed() {
    var obj = $('#pro_header');
    if (obj.length && obj.length > 0) {
        var objNext = obj.next();
        var Nexttop = objNext.get(0).getBoundingClientRect().top;

        if (Nexttop <= 0) {
            obj.addClass('active');
        } else {
            obj.removeClass('active');
        }
    }
}

// 关于我们头部二级导航定位
function headerAboutFixed() {
    var obj = $('#proAboutHeader');
    if (obj.length && obj.length > 0) {
        var yxtHeaderboxHeight = ($('#headerAboutBox').height()) * -1;
        var objHeader = $('#headerAboutBox').get(0).getBoundingClientRect().top;
        if (objHeader <= yxtHeaderboxHeight) {
            obj.addClass('active');
        } else {
            obj.removeClass('active');
        }
    }
}


// 页面内容渐入式出现
function animateSlideIn(ele) {
    var scrollList = $(ele);
    var winHeight = $(window).height();
    var winScrollTop = $(window).scrollTop();

    var curr = $('.had-visible');
    if (curr.length>0 && curr.length >= scrollList.length) {
        // 元素全部加好样式后，不再向下执行
         return
    }

    for (var i = 0; i < scrollList.length; i++) {
        var scrollListHeight = $(scrollList[i]).height();
        var scrollListTop = $(scrollList[i]).offset().top + scrollListHeight / 3;
        //        if( (winHeight + scrollListTop) < (winScrollTop + scrollListHeight / 3) || (winScrollTop + winHeight) < scrollListTop){
        if ((winScrollTop <= scrollListTop) && ((winScrollTop + winHeight) >= scrollListTop)) {
            // 可视区域
            $(scrollList[i]).addClass('had-visible');
        }
    }
}

// 乐才-功能轮播图，依赖 jQuery.CustomAnimation.js
if ($("#functionSlider").length > 0) {
    $("#functionSlider").customSlide({
        page: "#functionSlider .fnpage-list li",
        type: "slide",    //默认为slide,可选fade
        speed: 500,    //动画速度,默认为300
        time: 3000   //动画间隔时间，默认3000
    });
}

// 乐才-概览轮播图，依赖 swiper.min.js
if ($("#gailanSwiperContainer").length > 0) {
    var swiper = new Swiper('#gailanSwiperContainer', {
        slidesPerView: 2.5,
        spaceBetween: 180,
        loop: true,
        autoplay: true,
        centeredSlides: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });
}

// 网校-概览轮播图，依赖 swiper.min.js
if ($("#wangxiaoSwiperContainer").length > 0) {
    var swiper = new Swiper('#wangxiaoSwiperContainer', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });
}

// 会汇-概览轮播图，依赖 swiper.min.js
if ($("#hhuiSwiperContainer1").length > 0) {
    var swiper1 = new Swiper('#hhuiSwiperContainer1', {
        effect: 'cube',
        autoplay: true,
        navigation: {
            nextEl: '#btnNext'
        },
        on: {
            slideChangeTransitionEnd: function () {
                var index = this.activeIndex + 1 //切换结束时，告诉我现在是第几个slide 
                $('.swiper-title-list1 .swiper-title:nth-child(' + index + ')').addClass('active').siblings().removeClass('active');
            }
        }
    });
}
if ($("#hhuiSwiperContainer2").length > 0) {
    var swiper2 = new Swiper('#hhuiSwiperContainer2', {
        effect: 'cube',
        autoplay: true,
        navigation: {
            prevEl: '#btnPrev'
        },
        on: {
            slideChangeTransitionEnd: function () {
                var index = this.activeIndex + 1 //切换结束时，告诉我现在是第几个slide
                $('.swiper-title-list2 .swiper-title:nth-child(' + index + ')').addClass('active').siblings().removeClass('active');
            }
        }

    });
}

// 微课-概览轮播图，依赖 swiper.min.js
if ($("#weikeSwiperContainer").length > 0) {
    var swiper = new Swiper('#weikeSwiperContainer', {
        slidesPerView: 5,
        autoplay: true,
        spaceBetween: 50,
        centeredSlides: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });
}

// 锚点定位
anchor("#anchor li");
// 锚点定位
function anchor(ele) {
    if ($(ele).length > 0) {
        $(ele).click(function () {
            $(this).addClass('active').siblings().removeClass('active');
            $("html, body").animate({
                scrollTop: $($(this).find('a').attr("href")).offset().top + "px"
            }, 600);
            return false;
        });
    }
}

//滚动到锚点处导航样式跟着变化
navClass("#anchor li", ".anchorsession");
//直播-滚动到锚点处导航样式跟着变化
function navClass(anchorele, anchorToele) {
    var obj = $(anchorToele);
    if (obj.length > 0) {
        obj.each(function (i) {
            var rextop = $(this).get(0).getBoundingClientRect().top;
            var proHeadtop = $('#pro_header').height() + $(this).height() / 2;
            if (rextop <= proHeadtop) {
                var idname = $(this).attr('id');
                $(anchorele + ' a[name=' + idname + ']').parent().addClass('active').siblings().removeClass('active');
            }
        })
    }
}