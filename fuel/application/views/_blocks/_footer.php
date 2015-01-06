

<?php
//$this->load->model('code_model');
//$fb_data  = $this->code_model->get_fb_data();
?>

<div id="footerbox">
    <div id="footernavbox">
        <div class="nav">
            <ul>
                
                <li><a href="<?php echo site_url()?>home/aboutus/">關於我們</a></li>
              <!--  <li><a href="<?php echo site_url()?>home/campusevent/">校園活動</a></li>
            -->
                <li><a href="<?php echo site_url()?>home/terms/">使用者條款</a></li>
                <li><a href="<?php echo site_url()?>home/contact/">聯絡我們</a></li>
            </ul>
        </div>
    </div>
    <div id="footerinfobox">
        <div class="info">
            <div class="l">Copyright © 2013 - 2014 . PeopleSearch. All rights reserved.</div>
            <div class="r">"Young Talent”是PeopleSearch的促進就業推動以及⼈⼒資源改善計劃。</div>
        </div>
    </div>
</div>
<div id="logindatabox">
        <form action="<?php echo site_url()?>/register/step1_save/" method="POST" >
            <div class="close"></div>
            <div class="subject">快速註冊</div>
            <div class="line"></div>
            <div class="step1"><img src="<?php echo site_url()?>assets/templates/images/icon/step1.png"></div>
            <div class="account">
                <div class="title">電子郵件</div>
                <div class="input"><input type="text" class="mail" name="mail" id="mail" value=""></div>
                <div class="icon" id="mail_icon" ><div class="ok"></div></div>
            </div>
            <div class="password">
                <div class="title">密碼</div>
                <div class="input"><input type="password" class="password" name="password" id="password"  value=""></div>
                <div class="icon" id="password_icon" ><div class="ok"></div></div>
            </div>
            <div class="confirmpassword">
                <div class="title">確認密碼</div>
                <div class="input"><input type="password" class="confirmpassword" name="repassword" id="repassword" value=""></div>
                <div class="icon" id="repassword_icon"><div class="ok"></div></div>
            </div>
            <div class="agree">
                 <p>我同意<a href="<?php echo site_url()?>home/terms/">網站使用條款</a></p><input type="checkbox" name="agree" id="agree" >
            </div>
            <div class="submit">
                <input type="submit" class="submitbtn" name="submitbtn_1" id="submitbtn_1" value="送出">
            </div>
            
            <div class="fbbox">
                <p>使用臉書登入，又快又方便 &nbsp;&nbsp;&nbsp;&nbsp;</p> 
                <div><a href="<?php echo $fb_data['login_url'] ?>"><img src="<?php echo site_url()?>assets/templates/images/icon/loginFB.png"></a></div>
            </div>
        
        </form>
    </div>
      <div id="logindialog">
        <form action="<?php echo site_url()?>user/do_login" method="POST" >
            <div class="close"></div>
            <div class="subject">登入帳號</div>
            <div class="line"></div>            
            <div class="account">
                <div class="title">電子郵件</div>
                <div class="input"><input type="text" class="mail" name="login_mail" id="login_mail" value=""></div>
                <div class="icon"><div class="ok"></div></div>
            </div>
            <div class="password">
                <div class="title">密碼</div>
                <div class="input"><input type="password" class="password" name="login_password" id="login_password" value=""></div>
                <div class="icon"></div>
            </div>            
            <div class="submit">
                <input type="submit" class="submitbtn" name="submitbtn_2" id="submitbtn_2"  value="登入">
            </div>
            
            <div class="fbbox">
                <p>使用臉書登入，又快又方便 &nbsp;&nbsp;&nbsp;&nbsp;</p> 
                
                <div><a href="#"><img src="<?php echo site_url()?>assets/templates/images/icon/loginFB.png"></a></div>
            </div>
        
        </form>
    </div>

<script type="text/javascript">
$("#mail_icon").hide();
$("#password_icon").hide();
$("#repassword_icon").hide();

$("#password").blur(function(){
    //alert($("#password").val().length);
        
        if($("#password").val().match(/\d/) && $("#password").val().match(/[a-z]/i) && !$("#password").val().match(/[^a-z0-9]/)){
            
            if($("#password").val().length < 8 || $("#password").val().length > 14 ){
            alert('密碼長度需為8-14字元英數字結合');
            $("#password_icon").hide();
            //break;
            }
            //alert('ok');
            $("#password_icon").show();
        }else{
            alert('密碼長度需為8-14字元英數字結合');
            $("#password").val("");
            $("#password_icon").hide();

        }      
});

$("#repassword").blur(function(){
    //alert($("#password").val().length);
        
       if($("#repassword").val() != $("#password").val() ){
            alert('密碼必須要一致');
            $("#repassword").val("");
            $("#repassword_icon").hide();
       }else{
            //if(("#repassword").val() != ""){
                $("#repassword_icon").show();
           // }    
       }
});


$("#mail").blur(function(){
    //alert($("#password").val().length);
        
    var reg = /^[^\s]+@[^\s]+\.[^\s]{2,3}$/;
  if (reg.test($("#mail").val())) {
      $("#mail_icon").show();
  }else{
      $("#mail_icon").hide();
  }
});

$("#submitbtn_1").click(function(){
    //alert($("#repassword_icon").is(":visible"));
    //return false;
   if($("#mail_icon").is(":visible") && $("#password_icon").is(":visible") && $("#repassword_icon").is(":visible")){
        if($("#agree").is(":checked")){
            return true;
        }else{
            alert("請勾選同意網站使用條款！");
            return false;

        }
   }else{
        alert("請確定上述欄位填打正確！");
        return false;
   }
  
});

$("#submitbtn_2").click(function(){
    //alert($("#repassword_icon").is(":visible"));
    //return false;
   if($("#login_mail").val() == "" || $("#login_password").val() == ""){
        alert("請輸入帳號密碼");
            return false;
   }
   return true;
  
});

</script>

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 961814192;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/961814192/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<script type="text/javascript" src="<?php echo site_url()?>assets/js/site.js"></script>
<script type="text/javascript" src="<?php echo site_url()?>assets/js/fb.js"></script>