<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
    <title>Young Talent - 網站使用條款</title>    
    <meta property="og:title" content="Young Talent - 網站使用條款" />
    <meta property="og:description" content="年輕，就是你的優勢！我們是專屬於學生的工作職缺網站！累積工作經驗，從現在開始。我們有經過認證的工作職缺，把關的安全工作環境讓你的起步就是比別人快！" />
    <meta property="og:url" content="<?php echo site_url()?>" />
    <meta property="og:image" content="<?php echo site_url()?>assets/templates/images/pic/og_image.jpg" />   
    
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/reset.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/terms.css" type="text/css" media="all" >
    <link rel="stylesheet" href="<?php echo site_url()?>assets/templates/css/mysite.css" type="text/css" media="all" >
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/lib/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo site_url()?>assets/templates/Scripts/terms.js"></script>
</head>

<body>
    <div id="maincontain">
        <div id="contentbox">
            <?php $this->load->view('_blocks/_header')?>
            <div id="bodybox01">
                <?php echo fuel_block("iterms") ?>
            </div>
            
            <div id="bodybox02">
                <?php $this->load->view('_blocks/_facebook')?>
            </div>
        </div>
        <?php $this->load->view('_blocks/_footer')?>
    </div>
    <!-- *** -->
    <div id="wall"></div>
</body>
</html>

