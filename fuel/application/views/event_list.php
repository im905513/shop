<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
    <title></title>    
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/style2.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-ui-1.11.0.custom/jquery-ui.css" type="text/css" media="all" >
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-ui-1.11.0.custom/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/common.js"></script>
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
                <div id="eventslistbox">
                    <p class="title">活動列表</p>
                <?php
                    if(isset($results))
                    {
                        foreach($results as $row)
                        {
                ?>
                             <div class="item">
                                <div class="imgbox">
                                    <a href="<?php echo $event_detail_url.$row->event_id?>" target="_blank">
                                        <img src="<?php echo $photo_path.$row->event_photo?>" width="200" height="200">
                                    </a>
                                </div>
                                <p class="title" title="<?php echo $row->event_title?>"><?php echo mb_substr($row->event_title, 0, 8, "utf-8")?>...</p>
                                <p class="date"><?php echo mb_substr($row->event_start_date, 0, 16, "utf-8")?></p>
                            </div>                           
                <?php
                        }
                    }
                ?>
                    <br style="clear:both;">
                    <ul class="page">
                        <?php echo $page_jump;?>
                    </ul>
                </div>    
            </div>
            <div id="fbbox">
                <img src="<?php echo site_url()?>assets/templates/images/fbbox.png">
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
</body>
</html>