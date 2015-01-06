var DATA={};
jQuery(document).ready(function ($) {
    DATA.winW = $(window).width();
    DATA.winH = $(window).height();
    DATA.dom={};
   
    $( "#mybox .datepicker1" ).datepicker();


    $("#myrecordbox div.eventsrecordbtn").on("click",function(e){
        $("#myrecordbox div.eventsrecordbox").show();
        $("#myrecordbox div.recruitedbox").hide();
        $("#myrecordbox div.recruitedbtn").removeClass("active");
        $(this).addClass("active");
        
    });

    $("#myrecordbox div.recruitedbtn").on("click",function(e){
        $("#myrecordbox div.eventsrecordbox").hide();
        $("#myrecordbox div.recruitedbox").show();
        $("#myrecordbox div.eventsrecordbtn").removeClass("active");
        $(this).addClass("active");
        
    });

    
    
});