var DATA={};
jQuery(document).ready(function ($) {
    DATA.winW = $(window).width();
    DATA.winH = $(window).height();
    DATA.dom={};
    DATA.dom.banner=$("#banner");


    DATA.dom.banner.height(DATA.winW);
    DATA.dom.banner.height(DATA.winW*308/640);


});