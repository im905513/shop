var DATA={};
jQuery(document).ready(function ($) {
    DATA.winW = $(window).width();
    DATA.winH = $(window).height();
    DATA.dom={};
    DATA.dom.loginbox=$("#loginbox");
    DATA.dom.wall=$("#wall");
    DATA.dom.logindialog=$("#logindialog");




    DATA.dom.loginbox.click(function(){
       DATA.dom.logindialog.css({"left":(DATA.winW-DATA.dom.logindialog.width())/2+"px" , "top":(DATA.winH-DATA.dom.logindialog.height())/2+"px"});
       DATA.dom.logindialog.fadeIn();
    });

    DATA.dom.logindialog.find("div.close").click(function(){
        DATA.dom.logindialog.css({"left":(DATA.winW-DATA.dom.logindialog.width())/2+"px" , "top":(DATA.winH-DATA.dom.logindialog.height())/2+"px"});
        DATA.dom.logindialog.fadeOut();
    });

});