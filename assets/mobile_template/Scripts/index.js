var DATA={};
jQuery(document).ready(function ($) {
    DATA.winW = $(window).width();
    DATA.winH = $(window).height();
    DATA.dom={};
    DATA.dom.registration=$("a.registration");
    DATA.dom.login=$("a.login");
    DATA.dom.banner=$("#banner");


    DATA.dom.banner.height(DATA.winW);
    DATA.dom.banner.height(DATA.winW*585/640);


    //註冊
    DATA.dom.registration.click(function(){
       
    });

    //登入帳號
    DATA.dom.login.click(function(){
       
    });

});