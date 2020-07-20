//通用滚动插件
(function ($) {
    function CustomAnimation(element, option) {
        var _this = this;
        // 默认参数
        _this.defaultOption = {
            btnPre: null,
            btnNext: null,
            page: null,
            type: "slide",
            speed: 300,
            time: 3000,
            autoplay: true,
            callback: null
        };

        _this.element = element;
        _this.animationItem = _this.element.find(".modal-animation-item");
        _this.itemLength = _this.animationItem.length;
        _this.current = 0;

        _this.settings = $.extend({}, _this.defaultOption, option);
        _this.init();
    }

    /*初始化函数*/
    CustomAnimation.prototype.init = function () {
        var customAnimation = this;
        // 初始时-给当前活动的添加激活样式
        $(customAnimation.animationItem[0]).addClass('modal-animation-active');
        if (customAnimation.itemLength > 1) {
            if (customAnimation.settings.type == "slide") {
                customAnimation.animationFun = customAnimation.slidetoIndex;

            } else if (customAnimation.settings.type == "fade") {
                customAnimation.animationFun = customAnimation.fadetoIndex;
            }
            // 自动滚动
            if (customAnimation.settings.autoplay) {
                customAnimation.element.data('inv', setTimeout(function () {
                    customAnimation.animationFun(customAnimation.current + 1);
                }, customAnimation.settings.time));
            }

            // 鼠标移上停止滚动
            customAnimation.animationItem.parent().hover(function () {
                clearTimeout(customAnimation.element.data('inv'));
            }, function () {
                if (customAnimation.settings.autoplay) {
                    customAnimation.element.data('inv', setTimeout(function () {
                        customAnimation.animationFun(customAnimation.current + 1);
                    }, customAnimation.settings.time));
                }
            });


            if (customAnimation.settings.page != null) {
                $(customAnimation.settings.page).each(function (index) {
                    $(this).click(function () {
                        customAnimation.animationFun(index);
                    });
                });
            }
            $(customAnimation.settings.btnPre).on("click", function () {
                customAnimation.animationFun(customAnimation.current - 1);
            });

            // 触屏滑动事件
            //if(touch){
            //	var target = customAnimation.animationItem.parent().get(0);
            //	touch.on(target, 'touchstart', function(ev){
            //		ev.preventDefault();
            //	});
            //	touch.on(customAnimation.animationItem.parent().get(0),"swiperight",function(){
            //		customAnimation.animationFun(customAnimation.current-1);
            //	});

            //	touch.on(customAnimation.animationItem.parent().get(0),"swipeleft",function(){
            //		customAnimation.animationFun(customAnimation.current+1);
            //	});
            //}

            if (typeof touch != "undefined") {
                var target = customAnimation.animationItem.parent().get(0);
                touch.on(target, 'touchstart', function (ev) {
                    ev.preventDefault();
                });
                touch.on(customAnimation.animationItem.parent().get(0), "swiperight", function () {
                    customAnimation.animationFun(customAnimation.current - 1);
                });

                touch.on(customAnimation.animationItem.parent().get(0), "swipeleft", function () {
                    customAnimation.animationFun(customAnimation.current + 1);
                });
            }
            $(customAnimation.settings.btnNext).on("click", function () {
                customAnimation.animationFun(customAnimation.current + 1);
            });
        }
    }

    // 左右滑动
    CustomAnimation.prototype.slidetoIndex = function (index) {
        var customAnimation = this;
        if (!customAnimation.animationItem.is(":animated")) {
            clearTimeout(customAnimation.element.data('inv'));
            if (customAnimation.current > index) {
                index = index >= 0 ? index : customAnimation.itemLength - 1;
                customAnimation.animationItem.eq(index).css("left", "-100%");
                customAnimation.animationItem.stop().eq(index).animate({ "left": "0" }, customAnimation.settings.speed);
                customAnimation.animationItem.eq(customAnimation.current).animate({ "left": "100%" }, customAnimation.settings.speed);
                // 当前活动的添加激活样式
                customAnimation.animationItem.eq(index).addClass("modal-animation-active");
                customAnimation.animationItem.eq(customAnimation.current).removeClass("modal-animation-active");
                customAnimation.current = index;
            } else if (customAnimation.current < index) {
                index = index < customAnimation.itemLength ? index : 0;
                customAnimation.animationItem.eq(index).css("left", "100%");
                customAnimation.animationItem.stop().eq(index).animate({ "left": "0" }, customAnimation.settings.speed);
                customAnimation.animationItem.eq(customAnimation.current).animate({ "left": "-100%" }, customAnimation.settings.speed);
                // 当前活动的添加激活样式
                customAnimation.animationItem.eq(index).addClass("modal-animation-active");
                customAnimation.animationItem.eq(customAnimation.current).removeClass("modal-animation-active");
                customAnimation.current = index;
            }

            customAnimation.changePage(index);
            if (customAnimation.settings.autoplay) {
                customAnimation.element.data('inv', setTimeout(function () {
                    customAnimation.animationFun(customAnimation.current + 1);
                }, customAnimation.settings.time));
            }

        }


    }

    // 淡入淡出
    CustomAnimation.prototype.fadetoIndex = function (index) {
        var customAnimation = this;
        if (!customAnimation.animationItem.is(":animated") && customAnimation.current != index) {
            clearTimeout(customAnimation.element.data('inv'));
            // 当前活动的添加激活样式
            customAnimation.animationItem.eq(index).addClass("modal-animation-active");
            customAnimation.animationItem.eq(customAnimation.current).removeClass("modal-animation-active");
            if (customAnimation.current > index) {
                index = index >= 0 ? index : customAnimation.itemLength - 1;
                // 当前活动的添加激活样式
                customAnimation.animationItem.eq(index).addClass("modal-animation-active");
                customAnimation.animationItem.eq(customAnimation.current).removeClass("modal-animation-active");
            } else {
                index = index < customAnimation.itemLength ? index : 0;
                // 当前活动的添加激活样式
                customAnimation.animationItem.eq(index).addClass("modal-animation-active");
                customAnimation.animationItem.eq(customAnimation.current).removeClass("modal-animation-active");
            }
            customAnimation.animationItem.eq(index).css({ "left": "0", "opacity": "0", "z-index": "-1" });
            customAnimation.animationItem.eq(index).stop().animate({ "z-index": "50", "opacity": "1" }, customAnimation.settings.speed);
            customAnimation.animationItem.eq(customAnimation.current).stop().animate({ "opacity": "0", "z-index": "-1" }, customAnimation.settings.speed);

            //轮播背景颜色变化
            if (customAnimation.settings.callback) { customAnimation.settings.callback(customAnimation.animationItem.eq(index), index); }
            customAnimation.changePage(index);
            customAnimation.current = index;
            if (customAnimation.settings.autoplay) {
                customAnimation.element.data('inv', setTimeout(function () {
                    customAnimation.animationFun(customAnimation.current + 1);
                }, customAnimation.settings.time));
            }

        }
    }

    //切换分页
    CustomAnimation.prototype.changePage = function (index) {
        var customAnimation = this;
        if (customAnimation.settings.page != null) {
            var list = $(customAnimation.settings.page);
            list.eq(index).addClass("active").siblings().removeClass("active");
        }
    }
    function Plugin(option) {
        return this.each(function () {
            var elem = $(this);
            new CustomAnimation(elem, option);
        });
    }
    $.fn.customSlide = Plugin;
})(jQuery);