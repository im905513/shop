var DATA={};
jQuery(document).ready(function ($) {
    DATA.winW = $(window).width();
    DATA.winH = $(window).height();
    DATA.dom={};
    DATA.dom.addschool=$("#addschool");
    DATA.dom.schoollist=$("ul.schoollist");
    DATA.dom.joblist=$("ul.joblist");
    DATA.dom.addjob=$("#addjob");
    DATA.dom.submit=$("input.submit");

    //$( ".datepicker1" ).datepicker();
    // $( ".datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
    // $( "#birth" ).datepicker({ dateFormat: 'yy-mm-dd' });
    // $('input[type=date]').datepicker({
    //     // Consistent format with the HTML5 picker
    //     dateFormat: 'yy-mm-dd'
    // });

    
    // DATA.dom.addschool.click(function(){
    //    num=DATA.dom.schoollist.children("li").size()+1;  
    //    schoolItem = "<li class='l"+num+"'><input type='text' name='school"+num+"' value=''><br><div class='box'><input type='radio' class='schoolstate' name='schoolstate"+num+"' value='' checked><span>畢業</span><input type='radio' class='schoolstate'  name='schoolstate"+num+"' value=''><span>在學</span></div></li>";  
    //    DATA.dom.schoollist.append(schoolItem);
    // });

    // DATA.dom.addjob.click(function(){
    //    num=DATA.dom.joblist.children("li").size()+1; 
    //    jobItem ="<li class='l"+num+"'><input type='text' name='company"+num+"' value=''><br><input type='text' name='position"+num+"' value=''><br><input type='text' class='datestart datepicker"+num+"' name='datestart"+num+"' value=''>&nbsp;&nbsp;&nbsp;~&nbsp;&nbsp;&nbsp;<input type='text' class='dateend datepicker"+num+"' name='dateend"+num+"' value=''><br></li>";
    //    DATA.dom.joblist.append(jobItem);
    //    $( ".datepicker"+num ).datepicker();
    // });

    DATA.dom.submit.click(function(){

    });
});