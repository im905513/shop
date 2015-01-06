<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
    <title></title>    
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/style2.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/event.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-ui-1.11.0.custom/jquery-ui.css" type="text/css" media="all" >
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-ui-1.11.0.custom/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/common.js"></script>
    <!-- Include Google Maps API (Google Maps API v3 已不需使用 API Key) -->
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <!-- Require jQuery v1.7.0 or newer -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/query.tinyMap.min.js"></script>
</head>

<body>
    <div id="maincontain">
        <div id="contentbox">
            <div id="headerbox">
                <div id="header">
                    <a class="logo" href="#"><img src="<?php echo site_url()?>assets/templates/images/logo/logo.png"></a>
                    <div class="usr">您好，<span>使用者名稱</span></div>
                    <ul class="menu">
                        <li><a href="#">職缺列表</a></li>
                        <li><a href="#">活動報名</a></li> 
                        <li><a href="#">登出</a></li>             
                    </ul>  
                </div>                          
            </div>
            <div id="mybox">                
                <div id="eventbox">
                    <div class="subjectbox">
                        <?php echo $result->event_title?>
                        <p class="date"><?php echo mb_substr($result->event_start_date, 0, 10, "utf-8")?></p>
                    </div>
                    <div class="photobox">
                        <img src="<?php echo $photo_path.$result->event_photo?>" width="950" height="470">
                    </div>
                    <a href="#" class="addevent">加入活動</a>
                    <div class="contentbox">
                        <div class="llbox">
                            <?php echo $result->event_detail;?>
                        </div>
                        <div class="rrbox">
                            <div class="infobox">
                                <p>時間: <?php echo mb_substr($result->event_start_date, 0, 16, "utf-8")?> ~ <?php echo mb_substr($result->event_end_date, 0, 16, "utf-8")?></p>
                                <p>地點： <span id="EventPlace"><?php echo $result->event_place?></span></p>
                                <p>
                                    費用：
                                    <?php
                                        if($result->event_charge == 0)
                                        {
                                            echo "免費";
                                        }
                                        else
                                        {
                                            echo $result->event_charge;
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="mapbox">

                            </div>
                        </div>
                    </div>
                    <p class="msgbox">已加入活動：<span id="RegiNum"><?php echo $regi_num?></span>/<span id="RegiLimit"><?php echo $result->regi_limit_num?></span></p>
                    <a href="#" class="addevent">加入活動</a>
                </div>    
            </div>
            <div id="fbbox">
                <img src="images/fbbox.png">
            </div>
            <div id="footerbox">
                <div id="footernavbox">
                    <div class="nav">
                        <ul>
                            <li><a href="#">關於我們</a></li>
                            <li><a href="#">刊登職缺</a></li>
                            <li><a href="#">找打工</a></li>
                            <li><a href="#">常見問題</a></li>
                            <li><a href="#">使用者條款</a></li>
                            <li><a href="#">會員中心</a></li>
                            <li><a href="#">聯絡我們</a></li>
                        </ul>
                    </div>
                </div>
                <div id="footerinfobox">
                    <div class="info">
                        <div class="l">Copyright © 2013 - 2014 . PeopleSearch. All rights reserved.</div>
                        <div class="r">“JobFinder”是PeopleSearch的促進就業推動以及人力資源改善計劃。</div>
                    </div>
                </div>
            </div>
        </div>
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
                
                <div><a href="<?php echo $fb_data['login_url'] ?>"><img src="<?php echo site_url()?>assets/templates/images/icon/loginFB.png"></a></div>
            </div>
        
        </form>
    </div>
    <script>
        jQuery(document).ready(function(o){function t(){DATA.dom.logindialog.css({left:(DATA.winW-DATA.dom.logindialog.width())/2+"px",top:(DATA.winH-DATA.dom.logindialog.height())/2+"px"}),DATA.dom.logindialog.fadeIn()}DATA.winW=o(window).width(),DATA.winH=o(window).height(),DATA.dom={},DATA.dom.loginbox=o("#loginbox"),DATA.dom.logindatabox=o("#logindatabox"),DATA.dom.logindialog=o("#logindialog");var i=o("#EventPlace").text(),e=parseInt(o("#RegiNum").text()),n=parseInt(o("#RegiLimit").text());o(".mapbox").tinyMap({center:i,zoom:15,scrollwheel:!1,marker:[{addr:i}]}),o(".addevent").on("click",function(){if(e==n)alert("報名活動名額已滿");else{var i="<?php echo mb_substr($result->event_start_date, 0, 16, 'utf-8')?>",l="<?php echo mb_substr($result->event_end_date, 0, 16, 'utf-8')?>",d="確認要參加「<?php echo $result->event_title?>」活動？ 活動時間:"+i+"~"+l,a=confirm(d);if(a!==!0)return;o.ajax({url:"<?php echo $regi_url?>",type:"POST",dataType:"json"}).done(function(o){console.log(o),-99==o.status?t():1==o.status?(alert(o.msg),window.close()):alert(-2==o.status?o.msg:-3==o.status?o.msg:o.msg)}).fail(function(){alert("伺服器傳輸有誤")})}}),DATA.dom.logindialog.find("div.close").click(function(){DATA.dom.logindialog.css({left:(DATA.winW-DATA.dom.logindialog.width())/2+"px",top:(DATA.winH-DATA.dom.logindialog.height())/2+"px"}),DATA.dom.logindialog.fadeOut()})});
    </script>
</body>
</html>

